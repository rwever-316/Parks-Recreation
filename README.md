![filmstrips](resources/filmstrips.jpg)  

![yosemite](resources/yosemite.gif) 

![filmstrips](resources/filmstrips.jpg)

# **PARKS & RECREATION Database Project**
-------------------------------------------------------------------------------------------------
Language: English  
This is the submitted version (Stable).  
Last Updated: 05/01/2016  
Release date: 05/02/2016  
### **INTRODUCTION**

The Parks & Recreation web application retrieves information about different parks that have associated trails and camps with various activities.
All the information is stored in a relational database and various selections are provided via the web interface that make SQL queries to the database and present the results.
Other contents include project information and team members contact.



### **REQUIREMENTS**

1. **MICROSOFT WINDOWS 10**  
2. **Install WAMP software**  
3. **Copy contents of supplied .zip file**
4. **Import database content**

_Recommended Browsers_ (in order of preference):
- ![Firefox](resources/firefox_icon.png) Mozilla Firefox (minimum version 45.0.1)
- ![Chrome](resources/Chrome-Logo.png) Google Chrome (minimum version 50.0.2661.94 m)
- ![Edge](resources/microsoft-edge-logo.png) Microsoft Edge (minimum version 25.10586.0.0)
- ![Explorer](resources/ie-logo.png) Internet Explorer (minimum version 11.212.10586)

### **INSTRUCTIONS**

Prerequisite to installing WAMP software:  
- Make sure that you are "up to date" in the redistributable packages:
- VC9 Packages (Visual C++ 2008 SP1)  
http://www.microsoft.com/en-us/download/details.aspx?id=5582  
http://www.microsoft.com/en-us/download/details.aspx?id=2092  
- VC10 Packages (Visual C++ 2010 SP1)  
http://www.microsoft.com/en-us/download/details.aspx?id=8328  
http://www.microsoft.com/en-us/download/details.aspx?id=13523  
- VC11 Packages (Visual C++ 2012 Update 4)  
The two files `VSU4Wvcredist_x86.exe` and `VSU4Wdcredist_x64.exe`  
to be downloaded are on the same page: http://www.microsoft.com/en-us/download/details.aspx?id=30679  
- VC13 Packages (Visual C++ 2013)  
The two files `VSU4Wvcredist_x86.exe` and `VSU4Wdcredist_x64.exe`  
to be downloaded are on the same page: http://www.microsoft.com/en-us/download/details.aspx?id=40784 
- VC14 Packages (Visual C++ 2015)  
The two files `VSU4Wvcredist_x86.exe` and `VSU4Wdcredist_x64.exe`  
to be downloaded are on the same page: http://www.microsoft.com/en-us/download/details.aspx?id=48145  

_If you have a 64-bit Windows, you must install both 32 and 64bit versions, even if you do not use Wampserver 64 bit._  
- Close Skype.
- Disable IIS.  

**1.** Install WAMP software.  
Administrative rights are required to install the WAMP software.  
WAMP is a Windows Web development environment for Apache, MySQL, PHP databases.  
Download the WAMP software available at: https://sourceforge.net/projects/wampserver/  
The current download file is: `wampserver3_x86_apache2.4.17_mysql5.7.9_php5.6.15.exe`  
Install the WAMP software using with the following selections:
   - Language: English
   - Next
   - License Agreement: I accept the agreement
   - Next
   - Information: Next
   - Select Destination Location: C:\wamp
   - Next
   - Select Start Menu Folder: Wampserver
   - Next
   - Select Additional Tasks: ![checked](resources/checked.png) Create desktop icon  
   - Next
   - Ready to Install: Install
   - Default Browser selection is IE Explorer.  Do not choose another browser, select NO.
   - Default text editor is The Notepad.  Don not choose another text editor, select NO.
   - Information: Next
   - Setup -Wampserver: ![checked](resources/checked.png) Launch Wampserver
   - Finish
   - WAMP install is complete. 

The default folder is **C:\wamp**  
The default account name is: root and no password.


**2.** Copy contents of supplied .zip file  
Inside the directory **C:\wamp\www** create a new folder called **parks**
- Extract the contents of the submitted zip file into **C:\wamp\www\parks**

**3.** Import database content  
Open phpMyAdmin by left-clicking on ![tray](resources/tray.png) found on the system tray and  
left-click ![wamp](resources/wamp.png) then left-click on "phpMyAdmin"
- Login with **"user" = "root"**, "**password" = ""**.  Press ` Go `.
- From top menu ![menu](resources/menu.png),  
select ![import](resources/import.png)
- Under File to Import, select Browse..., then navigate to C:\wamp\www\parks and select data.sql, and click Open
- Select ` Go ` button on bottom of **Importing into the current server screen**
- Wait for screen to change to confirm importing
At this point the import of data to database is complete.

### **PROGRAM USE**
**1.** Open a browser page and use address http://localhost/parks  
**2.** To observe the different SQL queries you can choose options and press the appropriate ![submit](resources/submit.png) submit button.


### **CONTRIBUTIONS**

###### TEAM MEMBER | CONTRIBUTION
CESAR AVITIA:
- Provided contribution with planning
- Submitted one ER Diagram mock-up  
- Contributed to Normalized ER Diagram
- Created SQL script (create, insert/update statements) for creating and populating tables
- Contributed to UI bug fixes
- Contributed segment to video presentation
- Attended 7 out of 7 meetings

BRENDA REARDEN:
- Made the Google Docs we needed
- Provided contribution with planning
- Submitted one ER Diagram mock-up  
- Contributed and generated Normalized ER Diagram
- Wrote queries one and two in PHP (Rudi added the functionality of it to connect to the database and refactored)
- Refactored the logic in PHP for queries three and four (Pair programmed with Cord)
- Contributed segment to video presentation
- Video Presentation merging, editing, and publishing
- Moral support for all the awesome stuff Rudi was doing
- Attended 7 out of 7 meetings

CORD REARDEN:
- Provided contribution with planning
- Submitted one ER Diagram mock-up 
- Wrote queries three and five in PHP (Rudi added the functionality of it to connect to the database and refactored)
- Refactored the logic in PHP for queries three and four (Pair programmed with Brenda)
- Contributed to Normalized ER Diagram
- Contributed segment to video presentation
- Attended 6 out of 7 meetings

RUDI WEVER:
- Helped with planning by outlining project domain
- Contributed to and submitted ER Diagram
- Contributed to Normalized ER Diagram
- Defined queries to showcase functionality of the database
- Established GitHub repository for version control and distribution
- Refined SQL command to accurately reflect query five
- Designed, Developed, and Tested UI
- Refactored logic in PHP for all queries
- Created README file
- Contributed segment to video presentation
- Attended 7 out of 7 meetings

### **COPYRIGHT** 
Copyright ![copyright](resources/copyright-symbol.png) 2016, SER 322: Database Management, Team 1 all rights reserved.  

By downloading, copying, installing or using the software you agree to this license.
If you do not agree to this license, do not download, install,
copy or use the software.  

Redistribution in source and binary forms, with or without modification,
are not permitted.  Software is provided for the sole purpose of fulfilling educational requirements.  This software is provided by the copyright holders and contributors "as is" and
any express or implied warranties, including, but not limited to, the implied
warranties of merchantability and fitness for a particular purpose are disclaimed.
In no event shall copyright holders or contributors be liable for any direct,
indirect, incidental, special, exemplary, or consequential damages
(including, but not limited to, procurement of substitute goods or services;
loss of use, data, or profits; or business interruption) however caused
and on any theory of liability, whether in contract, strict liability,
or tort (including negligence or otherwise) arising in any way out of
the use of this software, even if advised of the possibility of such damage.