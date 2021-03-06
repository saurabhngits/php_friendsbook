> <br /> **Table of Contents** : 
>
> *[1. Pre-Requisites](#pre_requisites)* <br />
> *[2. Import Required SQL](#import_sql)* <br />
> *[3. Run Project](#run_project)* <br />
> *[4. Extra Documents](#extra_documents)* <br />
> *[5. Default Usernames and Passwords](#user_pass)* <br />
> <br />

<br />
<br />

# 1. Pre-Requisites <a id="pre_requisites"></a>
Need to install [*WAMP Server*](https://sourceforge.net/projects/wampserver/files) on your system. ***WAMP Server*** a Windows Web development environment for `Apache`, `MySQL` and `PHP` databases.

<br />
 
<center> OR </center> 

<br />

Need to install [**XAMPP Server**](https://sourceforge.net/projects/xampp) on your system. ***XAMPP Server*** is an easy to install Apache distribution containing `MySQL`, `PHP` and `Perl`.

<br />
<br />

# 2. Import Required SQL <a id="import_sql"></a>

1. Create new folder with name ***friendsbook*** inside the ***root*** folder of ***WAMP*** or ***XAMPP*** server  and clone this repository into that folder.

    E.g. for ***WAMP*** in ***www*** folder:

        C:\wamp\www\friendsbook
    
    <br />

2. Start ***WAMP*** server in your operating. On started you see it's ***icon*** in taskbar as shown in below image. Click on that icon and then click ***phpMyAdmin***.

<br />

![WAMP phpMyAdmin](./EXTRA_DOCUMENTS/images/readme_open_wamp_server_phpmyadmin.png)

<br />

This action will prompt to browser at address ***http://localhost:8080/phpmyadmin***.
Enter defualt ***Username*** as `root` and keep ***Password*** blank --> press ***Go***.

You will see below home page of ***phpMyAdmin***. 
Click on ***Import*** tab --> Click on ***Choose File*** --> Select ***my_facebook_data.sql*** from folder ***EXTRA DOCUMENTS*** of this repository -->  press ***Go***.

<br />

![phpMyAdmin](./EXTRA_DOCUMENTS/images/readme_phpmyadmin_import.png)

<br />

After these actions you can see on left hand side that ***my_facebook_data*** has been imported.

<br />
<br />

# 3. Run Project <a id="run_project"></a>

Again click on ***WAMP*** server icon in the taskbar then click ***Localhost*** as below.

<br />

![WAMP Localhost](./EXTRA_DOCUMENTS/images/readme_open_wamp_server_localhost.png)

<br />

This action will prompt to browser at address ***http://localhost:8080***.

<br />

![Localhost](./EXTRA_DOCUMENTS/images/readme_localhost.png)

<br />

Click on your project i.e. ***friendsbook*** will redirect to project index page.

<br />

![Project Index Page](./EXTRA_DOCUMENTS/images/readme_index_page.png)

<br />
<br />

# 4. Extra Documents <a id="extra_documents"></a>

Extra Documents are just to reference and to understand this project that you can remove later. It contain `doc` file and `images` that are used in this ***README*** file.

<br />
<br />

# 5. Default Usernames and Passwords <a id="user_pass"></a>

***friendsbook*** encrypt user's passwords with hashing which is not visible into the database also, so following are some dummy users are inserted in to the database of this project.

- prajakta_sh01@gmail.com   |    Password@123
- vikrant_j02@gmail.com     |    Password@123
- sush_p01@yahoo.com        |    Password@123
- khaire_919@gmail.com	    |    Password@123