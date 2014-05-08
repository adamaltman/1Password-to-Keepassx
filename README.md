1Password-to-Keepassx
=====================

Convert 1Password data to KeepassX XML format for easy import.  Note, KeePassX cannot house all of your 1Password data, or at least not with the same structure as 1Password.  KeePassX basically has:

* Groups, which have a title and an icon.
* Entries, which have a title, username, password, url, comment, icon, creation timestamp, lastaccess timestamp, lastmod timestamp, expire timestamp (or never).

It is not clear what kind of validation or limits there are for the particular fields.  And I hope your data is reasonable, but of course you could have a username or comment that may be too long for KeePassX (I just don't know what too long means).

I noticed when I exported some test data to the KEEPASSX_DATABASE XML format, some values were changed: `&` became `&amp;`.  I don't know what other nuances may exist.

In other words, this script may not work for you.  None of the three 1Password to KeePassX import scripts worked for me.


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

Built With
----------
1Password - Version 3.8.21 (build 32009)
KeePassX - Version 0.4.3

Requirements
____________
PHP 5.3+