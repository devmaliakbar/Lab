# PAGE SIMILARITY CHECKER
Check the similarity within the page itself.

### PROBLEM STATEMENT
The goal of this research is to determine the similarities within the HTML document. The problem is that our engine sometimes marks FP (False Positive) of the brand pages such as Amazon, Alibaba. This engine is developed to capture the Social Engineering attacks. Some of these FP pages are ecommerce websites. The goal is to eradicate these FP’s.
### HYPOTHESIS
The proposed solution to this problem is that all of these ecommerce sites have huge similarities within itself. All these sites display products, to display products they use a similar html code. This repetition of the code within the html page can indicate the presence of the ecommerce site. Of Course few other heuristics also apply.
### BLOCKERS
To check the similarity with the page we have few blockers. The major problem was the content of every product for instance we have this code snippet.
```html
<div class="child even" id="child_one">
    <a href="#">Child One</a>
    <p>This is Child One</p>
</div>
<div class="child odd" id="child_two">
    <a href="#">Child Two</a>
    <p>This is Row One Child Two</p>
</div>
<div class="child even" id="child_three">
    <a href="#">Child Three</a>
    <p>This is Row One Child Three</p>
</div>
```
Now here we have three childs having the same structure to represent a product but the inner content varies. First child shows “Child One” and the description shows “This is Child One”. Now for this we cannot compare child one with child two.
In this case equality is out of the question because child_one is not equal to child_two.
```html
<div class="child even" id="child_one">
    <a href="#">Child One</a>
    <p>This is Child One</p>
</div>
<div class="child odd" id="child_two">
    <a href="#">Child Two</a>
    <p>This is Row One Child Two</p>
</div>
```
Another problem is the attributes of a tag such as class, id, style, width, href, height and so on. These are the few of the attributes that we know of here is the list of the remaining attributes.
[https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/](https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes/)
Then there are data attributes which developers can set by themselves. These attributes also cause problems in matching the structure of the html. Class child even is not equal to class child odd.
Not to forget the coding styles and whether the coding standards are being followed or not.
### ASSUMPTIONS
Now to start off from somewhere we have taken few assumptions for now.
All the sections are divided by divs and coding standards are being followed.
### PROCEDURE
To start off we are removing all the inner contents of the html tags, comments style and script tags.
Furthermore we are also removing all the attributes. After removing all the unnecessary data we extract the divs from the html source code. Now as we have the code to the simplest form we can simple search the div code within our simplified source code. After getting the exact count of the occurrence we then multiply the number with its length.
Let's do Math
### SAMPLE DATA
Here is our sample input 
```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div>
        <div class="row1">
            <div class="child1">
                <a href="#">Child One</a>
                <p>This is Child One</p>
            </div>
            <div class="child2">
                <a href="#">Child Two</a>
                <p>This is Row One Child Two</p>
            </div>
            <div class="child3">
                <a href="#">Child Three</a>
                <p>This is Row One Child Three</p>
            </div>
        </div>
        <div class="row2">
            <div class="child1">
                <a href="#">Child One</a>
                <p>This is This is Row Two Child One</p>
            </div>
            <div class="child2">
                <a href="#">Child Two</a>
                <p>This is Row Two Child Two</p>
            </div>
            <div class="child3">
                <a href="#">Child Three</a>
                <p>This is Row Two Child One</p>
            </div>
        </div>
    </div>
    <div>
        <p>This is footer</p>
    </div>
</body>
</html>
```
We get an input file path, we read the contents and simplify it. After the simplification here is the result of the content
```html
<html><head><meta/><title></title></head><body><div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div></div><div><p></p></div></body></html>
```
Now after the simplification we extract the content of the body because we are interested in the actual content that is being displayed on the browser not in the headers.
```html
<div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div></div><div><p></p></div>
```
The next step is to extract all the div from the body and start checking how many times a div was found in the simplified code.
Let’s take our first div from the code.
```html
<div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div></div>
```
We’ll then find the number of times this code chunk is found within the code. Here this is our main div so it is found one time.
The length of this div is 183, total length of the content was 262 this also includes the header and body tag in this example we are using that too. But in the future we’re going to remove it.
```python
length_of_div = 183
total_length = 262
occurance_of_div = 1
total_div_length_in_code = length_of_div * occurance_of_div
```
Here as we have only a single occurrence so length is 183.
Now we can simply compute the percentage
```python
percentage = (total_div_length_in_code / total_length) * 100
```
Here we get our percentage number which is 69.847. But as we can see the count is only one this means that this div in question only occurred one time it’s not repetitive. Let’s take a look at another div
```html
<div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div>
```
Now the occurrence of this div is 2 and the percentage it forms is 65.64. As this div was repeated so we can consider it as our highest percent of similarity of code contains. Obviously we’ll check all the other divs too and update the highest number based on the base check that the number of occurrences must be greater than 1.
RESULTS
After the detailed analysis of the code we also get the analysis part from our code.
```
=====================================================================
Total Text Length: 262.
---------------------------------------------------------------------
DIV having length 183 occurred 1 times.
Code block having total length of 183.
Removing this length from the total length (262) we get 79.
That makes 69.8473282442748 percent.
<div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div><div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 86 occurred 2 times.
Code block having total length of 172.
Removing this length from the total length (262) we get 90.
That makes 65.64885496183206 percent.
<div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 25 occurred 6 times.
Code block having total length of 150.
Removing this length from the total length (262) we get 112.
That makes 57.25190839694656 percent.
<div><a></a><p></p></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 25 occurred 6 times.
Code block having total length of 150.
Removing this length from the total length (262) we get 112.
That makes 57.25190839694656 percent.
<div><a></a><p></p></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 25 occurred 6 times.
Code block having total length of 150.
Removing this length from the total length (262) we get 112.
That makes 57.25190839694656 percent.
<div><a></a><p></p></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 86 occurred 2 times.
Code block having total length of 172.
Removing this length from the total length (262) we get 90.
That makes 65.64885496183206 percent.
<div><div><a></a><p></p></div><div><a></a><p></p></div><div><a></a><p></p></div></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 25 occurred 6 times.
Code block having total length of 150.
Removing this length from the total length (262) we get 112.
That makes 57.25190839694656 percent.
<div><a></a><p></p></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 25 occurred 6 times.
Code block having total length of 150.
Removing this length from the total length (262) we get 112.
That makes 57.25190839694656 percent.
<div><a></a><p></p></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 25 occurred 6 times.
Code block having total length of 150.
Removing this length from the total length (262) we get 112.
That makes 57.25190839694656 percent.
<div><a></a><p></p></div>
---------------------------------------------------------------------
---------------------------------------------------------------------
DIV having length 18 occurred 1 times.
Code block having total length of 18.
Removing this length from the total length (262) we get 244.
That makes 6.870229007633588 percent.
<div><p></p></div>
---------------------------------------------------------------------
=====================================================================
```
### CONCLUSION
We have found the percentage of similarity within our code through this method. By whether this method is of any use? Whether removing all the attributes and tags is useful for us? These are the questions that still need to be addressed. We get the naser by using this method and applying it on a number of urls both FP and TP to get the answer that whether we can classify our results and see if we get let's see more than 60 percent similarity the content in question is not malicious.

### FINAL VERDICT
This research failed, most of the malicious sites also have alot of similarity within itself. But new suggestions regarding this short research is most welcome. You can also point out the enhancements.
