// System.Collections and .Generic may not be needed
using System.Collections;
using System.Collections.Generic;
using System.IO;
using System.Net;
using UnityEngine;
using System;
using System.Text;

public class Networking : MonoBehaviour
{
    public void Uploadv2 (string uri, string filePath)
    {
        // Create a http request to the server endpoint that will use the
        // file and file description.
        HttpWebRequest requestToServerEndpoint =
        (HttpWebRequest)WebRequest.Create(uri);

        string boundaryString = "----" + DateTime.Now.Ticks.ToString("x");
        string fileUrl = filePath;

    // Set the http request header \\
    requestToServerEndpoint.Method = WebRequestMethods.Http.Post;
    requestToServerEndpoint.ContentType = "multipart/form-data; boundary=" + boundaryString;
    requestToServerEndpoint.KeepAlive = true;
    requestToServerEndpoint.Credentials = System.Net.CredentialCache.DefaultCredentials;
 
    // Use a MemoryStream to form the post data request,
    // so that we can get the content-length.
    MemoryStream postDataStream = new MemoryStream();
    StreamWriter postDataWriter = new StreamWriter(postDataStream);

    // Include value from the size text area in the post data
    postDataWriter.Write("\r\n--" + boundaryString + "\r\n");
    postDataWriter.Write("Content-Disposition: form-data; name=\"{0}\"\r\n\r\n{1}",
    "size",
    "10000000");
 
    // Include the file in the post data
    postDataWriter.Write("\r\n--" + boundaryString + "\r\n");
    postDataWriter.Write("Content-Disposition: form-data;"
    + "name=\"{0}\";"
    + "filename=\"{1}\""
    + "\r\nContent-Type: image/png\r\n\r\n",
    "image",
    Path.GetFileName(fileUrl),
    Path.GetExtension(fileUrl));
    postDataWriter.Flush();
 
    // Read the file
    FileStream fileStream = new FileStream(fileUrl, FileMode.Open, FileAccess.Read);
    byte[] buffer = new byte[1024];
    int bytesRead = 0;
    while ((bytesRead = fileStream.Read(buffer, 0, buffer.Length)) != 0)
    {
        postDataStream.Write(buffer, 0, bytesRead);
    }
    fileStream.Close();
 
    postDataWriter.Write("\r\n--" + boundaryString + "--\r\n");
    postDataWriter.Write("Content-Disposition: form-data; name=\"upload\"\r\n\r\n");
    postDataWriter.Write("Upload screenshot");
    postDataWriter.Write("\r\n--" + boundaryString + "--\r\n");
    postDataWriter.Flush();
 
    // Set the http request body content length
    requestToServerEndpoint.ContentLength = postDataStream.Length;
 
    // Dump the post data from the memory stream to the request stream
    using (Stream s = requestToServerEndpoint.GetRequestStream())
    {
        postDataStream.WriteTo(s);
    }
    postDataStream.Close();
    }