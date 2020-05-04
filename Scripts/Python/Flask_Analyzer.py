from flask import Flask, jsonify, request
from flask_sqlalchemy import SQLAlchemy
from sqlalchemy import Column, Integer, String, Float, Text, DateTime
import os
from flask_marshmallow import Marshmallow
import pprint
import json
import requests

app = Flask(__name__)
basedir = os.path.abspath(os.path.dirname(__file__))
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://username:%s@localhost/analyzer' %  ('password')
db = SQLAlchemy(app)
ma = Marshmallow(app)
UPLOAD_DIRECTORY = "/home/ali.akbar@ebryx.com/Projects/kits"
DJANGO_API_URL = "http://0.0.0.0:8000/miner_api/analysis/"

@app.cli.command('db_create')
def db_create():
    db.create_all()
    print('Database created!')


@app.cli.command('db_drop')
def db_drop():
    db.drop_all()
    print('Database dropped!')


@app.cli.command('db_seed')
def db_seed():
    print('Database seeded!')


@app.route('/')
def hello_world():
    return 'Hello World!'


@app.route("/request/", methods=["POST"])
def requestCapture():
    if 'file' not in request.files:
        print('No File Found Do something here')
    file = request.files['file']
    if file.filename == '':
        print('No selected file')
    if file:
        filename = os.path.join(UPLOAD_DIRECTORY, file.filename)
        file.save(filename)
        name = request.form['filename']
        hashs = request.form['hash']
        kit_id = request.form['id']
        status = 'new'
        path = filename
        new_request = Request(
            name = name,
            hash = hashs,
            kit_id = kit_id,
            status = status,
            path = path
        )
        db.session.add(new_request)
        db.session.commit()
        return jsonify(message="Request Noted"), 201
    else:
        return jsonify(message="Error"), 500
    return jsonify(message="Why am I here"), 500


@app.route("/analyzed/", methods=["POST"])
def analyzedCapture():
    data = json.loads(request.data)
    request_id = int(data['request_id'])
    db.session.query(Analysis).filter(Analysis.request_id == request_id).delete()

    for key in data.keys():
        if key not in ['request_id', 'kit_id']:
            feature = key
            value = json.dumps(data[key])
            new_analytics = Analysis(
                value = value,
                feature = feature,
                request_id = request_id
            )
            db.session.add(new_analytics)
            db.session.commit()
    r = requests.post(DJANGO_API_URL, data=request.data)
    if r.status_code == 201:
        req = Request.query.filter_by(id=request_id).first()
        if req:
            req.status = 'completed'
            db.session.commit()
        return jsonify(message="Data Updated"), 201
    else:
        return jsonify(message="Main Data Not Updated"), 500


# Url: http://127.0.0.1:5000/request/new
# Gets the list of requests
@app.route('/request_all/', methods=['GET'])
def requestGetAll(status: str):
    reqs = Request.query.all()
    if reqs:
        results = [r.to_json() for r in reqs]
        return jsonify(results)
    else:
        return jsonify(message="No Requests Found"), 404


# Url: http://127.0.0.1:5000/request/new
# Gets the list of requests
@app.route('/request/<string:status>', methods=['GET'])
def requestGetByStatus(status: str):
    reqs = Request.query.filter_by(status=status).all()
    if reqs:
        results = [r.to_json() for r in reqs]
        return jsonify(results)
    else:
        return jsonify(message="No Request Found"), 404


# Url: http://127.0.0.1:5000/request/1
# Get the request by id
@app.route('/request/<int:id>', methods=['GET'])
def requestGetByID(id: int):
    data = Request.query.filter_by(id=id).first()
    if data:
        print(data.to_json())
        # result = request_schema.dump(data)
        return jsonify(data.to_json())
    else:
        return jsonify(message="No Request Found having this id"), 404


# DB MODELS
class Request(db.Model):
    __tablename__ = 'requests'
    id = Column(Integer, primary_key=True)
    name = Column(Text, nullable=True)
    path = Column(Text, nullable=True)
    hash = Column(String(100))
    kit_id = Column(Integer)
    status = Column(String(15))
    analysis = db.relationship('Analysis', backref='request', lazy='joined')

    def to_json(self):
        return {
            "id": self.id,
            "name": self.name,
            "hash": self.hash,
            "kit_id": self.kit_id,
            "analysis": [a.to_json() for a in self.analysis],
            "status": self.status,
            "path": self.path
        }


class Analysis(db.Model):
    __tablename__ = 'analysis'
    id = Column(Integer, primary_key=True)
    request_id = Column(Integer, db.ForeignKey('requests.id'), nullable=False)
    feature = Column(Text, nullable=True)
    value = Column(Text, nullable=True)

    def to_json(self):
        return {
            "id": self.id,
            "request_id": self.request_id,
            "feature": self.feature,
            "value": self.value
        }


class RequestSchema(ma.Schema):
    class Meta:
        fields = ('id', 'name', 'hash', 'kit_id', 'analysis', 'status', 'path')


class AnalysisSchema(ma.Schema):
    class Meta:
        fields = ('id', 'request_id', 'feature', 'value')


request_schema = RequestSchema()
requests_schema = RequestSchema(many=True)

analysis_schema = AnalysisSchema()
analysis_schema = AnalysisSchema(many=True)


if __name__ == '__main__':
    app.run()
