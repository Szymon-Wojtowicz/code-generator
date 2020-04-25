# code-generator in PHP7

Application executing in 2 modes, by browser and CLI. 

In both case application has identical functionality:
- User has possibility to define number of codes to generate
- User has possibility to define length of code
- Code should has small and big letters or digits
- Single call script must generate unique codes (for example 10000 unique 10 character codes)
- User must have possibility pass filename of file in which data will be saved
- Executing script from the browser user should see form in which he can write how many and how long codes he needs
- Executing script from the browser result is to be file with correct number of codes which we can download. 

Example call script from CLI: 

php console.php numberOfCodes=10000 lengthOfCode=10 filename=tmp/codes.txt

php console.php numberOfCodes=3000 lengthOfCode=5 filename=tmp/test.txt

php console.php numberOfCodes=500 lengthOfCode=5 filename

The first call should generate 10000 unique 10 character codes and save them to file /tmp/codes.txt 

You have earlier to make directory named tmp in folder with files of CodeGenerator. 
In this folder will be saved files with generated codes.

Example call script from browser:

http://localhost/CodeGenerator/form.html
