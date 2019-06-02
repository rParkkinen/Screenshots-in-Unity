using UnityEngine;
using System.IO;
using System.Collections.Generic;

public class ScreenCap: MonoBehaviour {
     // Here is the key for the screencapture, 
     // you can change it later on within the editor
     public KeyCode screenCaptureKey = KeyCode.F2;
    //What name it gets when saved
private string ScreenCapName = "CoolPix";

    // Filetype for the file
public string fileType = ".png";

    // Path for the screenshot to save
private string path = "C:/tmp/";


void Update()
{
    // When your capturekey is pressed
    if (Input.GetKeyDown(screenCaptureKey))
    {
        ScreenCapture.CaptureScreenshot(path + ScreenCapName + fileType);
        Debug.Log("ScreenCapture Taken!");
        Debug.Log("ScreenCap Location: " + path + ScreenCapName + fileType);
            string[] mylist = new string[] {(path) + ScreenCapName + fileType } ;
            Networking netw = new Networking();
       
            netw.Uploadv2("your website here", (path) + ScreenCapName + fileType);
        }
}


}