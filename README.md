# PHP & MySQL – Study Notes

Web Application Dev. PHP & MySQL. Chapter 1 (all) + Chapter 2 (slides 1–20).

## Introduction

**PHP** = Hypertext Preprocessor. A free, widely used, server-side scripting language for dynamic and interactive web pages (an alternative to Microsoft's ASP). The course is about building dynamic websites and apps with HTML, PHP, MySQL, JavaScript/jQuery and CSS. Textbook: *Learning PHP, MySQL & JavaScript with jQuery, CSS & HTML5* (6th ed.), Robin Nixon.

---

## Chapter 1 – Introduction to PHP & MySQL

### HTTP, HTML, client and server

- **HTTP**: the standard for requests and responses between the browser and the web server.
- **HTML**: the standard markup language for pages shown in a browser.
- **Server**: accepts a request and replies with something meaningful (e.g. the page).
- **Client**: the computer that makes the request. Also used for the browser.
- Routers, proxies and gateways can sit in between and make sure requests/responses get through.

Flow: browser asks for a page → server sends it → browser displays it.

### What is PHP?

- An **HTML-embedded scripting language**. Syntax borrowed from C and Java, plus some PHP-specific features.
- A **server** scripting language. The code runs on the server and can generate HTML, JSON, redirects, etc. It can also talk to databases like MySQL (instructor's notes).
- The server processes the PHP, shows what should be visible (content, pictures), hides the rest (file operations, calculations), turns it into **HTML** and sends that to the browser.

**What it can do:** cut the time to build large sites, customize the experience for each visitor, build online tools and shopping carts. It does everything a **CGI program** can (form data, dynamic content) and more. It runs on all major operating systems and web servers, supports procedural and object-oriented programming (or both), and supports many databases (MySQL, Oracle, SQL Server).

**Key features:** server-side execution, database connectivity, procedural + OOP, form processing, sessions and cookies, file handling, error handling, API development, frameworks (Laravel).

**Used for:** social media, e-commerce, blogs/CMS, search engines, knowledge bases, e-learning, entertainment (e.g. Facebook, Yahoo, Flickr, Wikipedia, WordPress, Tumblr, Mailchimp).

**Before starting you should know:** HTML (especially forms) and basic programming.

**What you need:** Windows + Apache + MySQL + PHP, a text editor, a browser, Git/GitHub.

### Setting up a development server

| Package | OS |
|---|---|
| LAMP | Linux |
| WAMP | Windows |
| MAMP | Macintosh |
| XAMPP | Cross-platform |

- **XAMPP** = Apache, MySQL, PHP, Perl. **WAMP** = Windows, Apache, MySQL, PHP.
- WAMP is Windows only, XAMPP is cross-platform. The other difference is security (WAMP was built with security in mind).
- Popular web servers: Apache, Nginx, Microsoft IIS (Apache is free and open-source, Apache License 2.0).
- XAMPP creates a local "sandbox" to write, deploy and test code. HTML works without a server, but PHP needs one.

**Installing XAMPP** (free from https://apachefriends.org/download.html): say Yes to the antivirus question, OK to the UAC warning (don't install in `C:\Program Files (x86)`), click Next through the wizard, Allow access in the firewall, then Finish.

**Running it:** open the XAMPP Control Panel and Start **Apache**. Start **MySQL** too if you're building database apps.

**VMware problem:** VMware's Authorization Service already uses **port 443**, so Apache won't start. Fix: Services → right-click *VMware Authorization Service* → Stop.

**Testing:** go to `localhost` or `127.0.0.1`. Apache's default port is **80**. If something else uses it (e.g. Skype), change the port (e.g. 8080) and add it to every URL:

```
localhost:8080/example.php
```

**Document root:** what loads when the URL has no path. Default: `C:/xampp/htdocs` (in general `**\xampp\htdocs`, where `**` is your install folder; the lecturer's is `D:\xampp\htdocs`).

**Test file:** save `<h1>This is a test</h1>` as `test.html` in `htdocs\test`, then open `localhost/test/test.html`. `htdocs` isn't in the address because it's the root folder.

**First PHP page:** save as `index.php` in `C://xampp/htdocs/test`:

```php
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home Page</title>
</head>
<body>
	Hello world!!!
	<?php
		 echo ("Welcome to PHP & MYSQL Course");
	?>
</body>
</html>
```

Open `http://localhost/test/`. No need to type `index.php`, because the **index page** loads automatically for a host/folder URL.

**Editor:** there are many (Notepad++, Sublime, phpDesigner...). IDEs add intellisense, debugging, autocompletion and syntax coloring. **We use Visual Studio Code.**

---

## Chapter 2 – PHP Fundamentals (slides 1–20)

### Basics

- PHP is a **hybrid language**, taking the best features of other languages (like C and Java).
- Files end in **.php**. The web server automatically passes them to the **PHP processor**.
- A PHP file mixes **text, HTML and PHP script**, and must be in the server's root directory (`C:/xampp/htdocs`).
- To run the first example, save it as `Index.php` with *Save as type = All Files* in `C:\xampp\htdocs` (or `C:\wamp\www`), then open `http://localhost/Index.php`. The body of the page is:

```php
This page will print the following text:<br>
<?php
    print "HELLO WORLD PHP!!! ";
?>
```

- PHP code goes between `<?php` and `?>`, and **every statement ends with `;`**.
- HTML tags work as normal. Inside `echo`/`print` you can add HTML tags and attributes, but use **single quotes for the attributes**.

### echo and print

Both output text and are **constructs** (built-in language features, not normal functions), so parentheses are optional.

- `echo` doesn't return a value and is faster. `print` returns a value.
- `echo` can take several parameters. `print` only one.
- `print` can be used in a ternary expression. `echo` can't.

```php
echo "Using echo with ", "two parameters"; // ok
print "Using print with ", "two parameters"; // error

// ternary = short form of if...else: (condition ? value_if_true : value_if_false);
($x < $y) ? print "$x is less than $y" : print "$x is greater than $y"; // ok
($x < $y) ? echo "$x is less than $y" : echo "$x is greater than $y"; // error
```

### Quotes

HTML has lots of quotes already, so it matters which you use.

```php
$a = 10;
echo 'Hello $a';   // Hello $a   (single quotes: taken exactly as written)
echo "Hello $a";   // Hello 10   (double quotes: variables get analyzed)
```

Single quotes don't analyze variables, which is why they're rarely used in PHP.

### Comments

```php
/* multi-line comment
   which will not be interpreted */

// single line comment
$x += 10; // Increment $x by 10

# this also works as a single line comment
```

### Variables

A **variable** is a location in memory where a value is stored for use at run time. It starts with `$`. You don't declare it or its type before using it, and its type can change as often as you like.

**Naming rules:**
- After `$`, start with a letter or `_`
- Only letters, numbers and `_`, no spaces
- **Case-sensitive**
- Keywords as names isn't strictly illegal but is bad practice
- Keywords (`if`, `else`, `echo`...), classes and functions are **not** case-sensitive

Multi-word names (slide notes): snake case `$user_name`, camel case `$userName`, Pascal case `$UserName`. Kebab case (`$user-name`) is **not allowed**.

### Data types

Basic types: **integers, floating-point numbers (real numbers), strings, booleans**. A variable "behaves" according to the data it holds.

A **string** is a sequence of letters, numbers, special characters and arithmetic values (or a mix), written in single or double quotes.

```php
$my_str = 'Welcome to PHP Republic';
echo strlen($my_str);          // Outputs: 23
echo str_word_count($my_str);  // Outputs: 4
```

### Constants

Like variables, but the value **can't change**. Same naming rules but **no `$`**. Only created with `define()`, and uppercase names are good practice.

```php
define("CONSTANT_NAME", value)   // value = any valid expression except arrays and objects

define("PI", 3.14);
echo "Value of PI is: ", PI;    // notice the 2 parameters

define("Age", 123);
echo Age;
```

### Operators

For mathematical, comparison and logical operations:

- Assignment: `=`
- Arithmetic: `+ - * / %`
- Arithmetic assignment: `+= -= *= /= %=`
- Comparison: `< <= > >= == !=`
- Logical: `&& || !`
- Concatenation: `.`
- Increment/decrement: `++ --`
- Ternary: `? :` (the one and only)

---

## Key Takeaways

- PHP runs on the server and sends plain HTML to the browser.
- Local setup = Apache + MySQL + PHP (XAMPP is cross-platform, WAMP is Windows only). Test with `localhost`, and change the port (e.g. 8080) if 80 is busy.
- Files go in `C:/xampp/htdocs`. `index.php` loads automatically.
- PHP code goes in `<?php ... ?>`, statements end with `;`.
- `echo` is faster and takes multiple parameters. `print` returns a value and works in a ternary.
- Double quotes read variables, single quotes don't.
- Comments: `/* */`, `//`, `#`.
- Variables start with `$` and are case-sensitive. Keywords and functions aren't.
- Types: integers, floats, strings, booleans.
- Constants: `define("NAME", value)`, no `$`.
