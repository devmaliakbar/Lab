from bs4 import BeautifulSoup, Comment, NavigableString
import csv
import hashlib
import os.path
from os import path
import json

# Extracts Text From URL and saves it in the file
def lab(file_path = "poc/input1.html", out_put_file_name = "poc/output.html"):

    # Reading the HTML File
    with open(file_path, 'r') as j:
        content = j.read()

    out_file = open(out_put_file_name, "w")

    # content = html.unescape(fileContent)
    soup = BeautifulSoup(content, "html5lib")

    # kill all script and style elements
    for script in soup(["script", "style"]):
        script.extract()  # rip it out

    # Getting Text and Comment Child
    childs = []
    for child in soup.recursiveChildGenerator():
        try:
            if isinstance(child, NavigableString) or isinstance(child, Comment):
                childs.append(child)
        except:
            pass

    # Killing childs
    for child in childs:
        child.extract()

    # print(soup)

    # Removing Attributes
    for tag in soup.recursiveChildGenerator():
        try:
            tag.attrs = {}
        except AttributeError:
            pass

    text = str(soup.body)
    percentage = div_snatcher(soup.body, text, out_put_file_name)
    return percentage


def div_snatcher(parent, text, out_put_file_name):
    divs = parent.find_all("div")
    total_length = len(text)
    out_file = open(out_put_file_name, "w")
    stats = {"highest_percentage": 0, "count": 0, "total_len": 0, "current_len": 0}
    stats["highest_percentage"] = 0
    stats["count"] = 0
    stats["total_len"] = total_length
    stats["current_len"] = 0
    out_file.write("=====================================================================\n")
    out_file.write("Total Text Length: {}.\n".format(total_length))
    for div in divs:
        count = text.count(str(div))
        current_length = (len(str(div)) * count)
        difference = total_length - current_length
        percentage = (current_length / total_length) * 100
        if count > 1:
            if stats["highest_percentage"] < percentage:
                stats["highest_percentage"] = percentage
                stats["count"] = count
                stats["current_len"] = current_length
        out_file.write('---------------------------------------------------------------------\n')
        out_file.write("DIV having length {} occurred {} times.\n".format(len(str(div)), count))
        out_file.write("Code block having total length of {}.\n".format(current_length))
        out_file.write("Removing this length from the total length ({}) we get {}.\n".format(total_length, difference))
        out_file.write("That makes {} percent.\n".format(percentage))
        out_file.write(str(div))
        out_file.write('\n---------------------------------------------------------------------\n')
    out_file.write("=====================================================================\n")
    out_file.close()
    return stats


def readCsv():
    # csv_input = "sociocop_run_results_18.csv"
    # csv_input = "sociocop_run_results_19.csv"
    csv_input = "sociocop_run_results_20.csv"
    # csv_output = "Out_sociocop_run_results_18.csv"
    # csv_output = "Out_sociocop_run_results_19.csv"
    csv_output = "Out_sociocop_run_results_20.csv"
    lol = list(csv.reader(open(csv_input, 'r'), delimiter='\t'))
    fp_tp = [["URL", "Hash", "Input File", "Verdict", "Max Similarity Precentage", "Detailed Analysis"]]
    sfptp = []
    for l in lol:
        single_element = l[0].split(",")
        input_file_hash = hashlib.sha256(single_element[0].encode('utf-8')).hexdigest()
        inp_file = os.path.join('data', str(input_file_hash) + '.htm')
        output_file = os.path.join('output', str(input_file_hash))
        print(inp_file)
        if path.exists(inp_file):
            percentage = lab(inp_file, output_file)
            sfptp.append(single_element[0])
            sfptp.append(input_file_hash)
            sfptp.append(inp_file)
            sfptp.append(single_element[2])
            sfptp.append(str(percentage))
            sfptp.append(output_file)
            fp_tp.append(sfptp)
            print("Exists.")
        sfptp = []
    with open(csv_output, 'w', newline='') as out_f:
        w = csv.writer(out_f, delimiter='\t')  # override for tab delimiter
        w.writerows(fp_tp)
    print(fp_tp)


def read_json(json_input, csv_output, input_directory, output_directory):
    with open(json_input, 'r') as j:
        json_dict = json.load(j)
    fp_tp = [["URL", "Hash", "Max Similarity Precentage", "Count", "Current Content Length", "Total Content Length", "Verdict", "Input File", "Output File Name"]]
    sfptp = []
    for jd in json_dict:
        print("=======================================================================")
        print(jd)
        print(json_dict[jd])
        print("=======================================================================")
        input_file_hash = hashlib.sha256(jd.encode('utf-8')).hexdigest()
        inp_file = os.path.join(input_directory, json_dict[jd])
        output_file = os.path.join(output_directory, str(input_file_hash))
        if path.exists(inp_file):
            try:
                percentage = lab(inp_file, output_file)
                sfptp.append(jd)
                sfptp.append(input_file_hash)
                sfptp.append(str(percentage["highest_percentage"]))
                sfptp.append(str(percentage["count"]))
                sfptp.append(str(percentage["current_len"]))
                sfptp.append(str(percentage["total_len"]))
                sfptp.append("Clean")
                sfptp.append(inp_file)
                sfptp.append(output_file)
                fp_tp.append(sfptp)
            except Exception as e:
                print("Some error with " + inp_file)
                print(e)
        sfptp = []
    with open(csv_output, 'w', newline='') as out_f:
        w = csv.writer(out_f, delimiter='\t')  # override for tab delimiter
        w.writerows(fp_tp)
    print(fp_tp)


read_json(json_input="27_april.json", csv_output="27_april.csv", input_directory="27_april", output_directory="27_april_out")
