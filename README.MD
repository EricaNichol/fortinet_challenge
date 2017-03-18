To Start, open up index.php.

##HIGHLIGHTS:

###Task 1:
Using AJAX to loop through files and store information in `new formData ` object to pass to PHP.

	var formData = new FormData();
	formData.append('file', file, orig_name);

Generating sessions with unique ID to store Original Name.
Allow users to see what files are in their uploads folder with no database.

###Task 2:
Elegant recursion function that call itself.

	giveMeAChance($number, $count + 1, $new_array);

##CHALLENGES:
###Task 1:
Using the combination of Php Uploader and JQuery.Filer to allow users to UPDATE name BEFORE upload to directory.

###Task 2:
Finding the base case and recursion with the correct parameters.
