1Password-to-KeePassX
=====================

Convert 1Password data to KeePassX XML format for easy import.  Note, KeePassX cannot house all of your 1Password data, or at least not with the same structure as 1Password.  KeePassX basically has:

* Groups, which have a title and an icon.
* Entries, which have a title, username, password, url, comment, icon, creation timestamp, lastaccess timestamp, lastmod timestamp, expire timestamp (or never).

It is not clear what kind of validation or limits there are for the particular fields.  And I hope your data is reasonable, but of course you could have a username or comment that may be too long for KeePassX (I just don't know what too long means).

In other words, this script may not work for you.  None of the three 1Password to KeePassX import scripts I could find worked for me.

Step 1 - Export your "Logins"
---------

* Export your "logins" from 1Password in a tab-delimited "Text File."
* Only export the title, username, password, and url/location.

Gripe: The 1pif file has an inconsistent JSON + text hybrid structure.  But the important fields, like password may appear in a variety of locations.  Without adhering to a clearly defined JSON template, I decided importing from a tab delimited text file was more straightforward.

Step 2 - Convert to XML
---------

Here you use the php script, which should run on Mac OSX from the terminal.
```php convert.php data.txt > output.xml```
You would replace `data.txt` with the name and relative path of the data file you exported in the first step.

Included in this repository is a sample data.txt file.


Step 3 - Import to KeePassX
--------

* Open up KeePassX, and select "Import From..." > "KeePassX XML".
* Inspect and save the database. You can organize your entries into groups later.


Step 4 - Delete Your Unencrypted Export
________

You should now securely delete your unencrypted xml file.  Put it in the trash can.  Hold down the command key, right click on the trash can, and select "Secure Delete".

Background
----------

I am moving from Mac to Linux, and 1Password doesn't work on Linux.  Importing password data into KeepassX is not terribly difficult, but you need to have the data in one of three particular formats.  This is the main format:

```
<!DOCTYPE KEEPASSX_DATABASE>
<database>
 <group>
   <title>Example Title</title>
   <icon>1</icon>
   <group>
     <title>Another Title - notice the groups nest</title>
     <icon>1</icon>
     <entry>
       <title>Google</title>
       <username>adam</username>
       <password>changeme</password>
       <url>www.google.com</url>
       <comment>This is just an example</comment>
       <icon>1</icon>
       <creation>2014-05-08T15:56:28</creation>
       <lastaccess>2014-05-08T15:56:28</lastaccess>
       <lastmod>2014-05-08T15:56:28</lastmod>
       <expire>Never</expire>
     </entry>
     ...
```
It's important to keep in mind that KeePassX doesn't keep track of as much data.  1Password has secure notes, cards, identities, etc...  You will need to figure out a solution for what to do with that data.

Feel free to contribute if you want to improve this tool.

Built With
----------

* 1Password - Version 3.8.21 (build 32009)
* KeePassX - Version 0.4.3
* Mac OSX - 10.7.5


Requirements
___________


* PHP 5.3+ (built on 5.3.28)
* Common sense
