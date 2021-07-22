# Azul

Azul is an all-in-one application for functionalities regarding student life. Instead of having multiple apps and depending on third party software to store details, conduct video call sessions or payment of dues, Azul unifies all these processes under on application and promote easy use, reliability and security.

<b>FRONT-END:</b> HTML5, CSS and JAVASCRIPT </br>
<b>BACK-END:</b> PHP and MYSQL (VIA XAMPP SERVER)

<h2>What can you do with Azul?</h2>
<li>Store and access student details and documents.
<li>Connect with fellow users via video call sessions.
<li>Payment portal for easy transactions.
<li>Daily to-do list to note down important tasks and deadlines.

<h2>Things to keep in mind:</h2>
<li> You must have installed the Xampp Server on your PC before running this application. PHP and MySQL used in the project works on this server.
<li> Make sure you have created a new database on the MySQL server to store and retrieve your data. Consequestly update your username, password and table names in the code wherever required.
<li> You need to build a new Google Firebase project for website hosting and real-time database communcation as required by the video-chat application. Please refer to the WEBRTC Documentation to learn in depth and also attaching a reference YouTube video to demonstrate its working. <br><br>
<table>
  <tr>
    <td> WebRTC Documentation: </td>
    <td> https://webrtc.org/getting-started/firebase-rtc-codelab </td>
  </tr>
  <tr>
    <td>Google Firebase Hosting:</td>
    <td>https://www.youtube.com/watch?v=w7xKZ5PWizs&list=PL1iqRnUsd9p6x5uzo9-HLo91POW6HfbEw&index=15</td>
  </tr>
  <tr>
    <td>YouTube Reference:</td>
    <td>https://www.youtube.com/watch?v=_3exOT53faw&list=PL1iqRnUsd9p6x5uzo9-HLo91POW6HfbEw&index=14</td>
  </tr>

</table>
<li> We have integrated the Payment Portal with the RazorPay Application. If you want this to work for your account or organization you need to first create an account with RazorPay and submit your documents for verification. Once that's verified and done you would be able to accept real-time payment transactions through your app.

  
  
<h2>How to run the Application?</h2>
<li> Download XAMPP and start the APACHE and MYSQL server.
<li> Make sure all the project files, other than the firebase files, are present in the htdocs folder of Xampp.
<li> Host the chat-application files (index.html, main.css and app.js) under public folder using Google Firebase and update the link of your website in the HOME.PHP file.
<li> After creating a new database for your project in MySQL update the email, password and other necessary fields in the project files.
<li> After creating your Razor Pay account, customize your 'Pay Button' and update the script tag in the HOME.PHP file. 
<li> Click on the Admin button next to Apache Server and change the path in the browser to the location of your files and start the application with the INDEX.PHP file.

![Screenshot (1346)](https://user-images.githubusercontent.com/64693139/126604758-73d17885-9270-41c3-9706-66157f1cb7d7.png)
![Screenshot (1348)](https://user-images.githubusercontent.com/64693139/126604974-7517f399-ef7d-49ea-8f72-48ecbe1e6aae.png)



