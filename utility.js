function createXMLHttpRequest()
{
  try						//其它非IE的瀏覽器
  {
    var XHR = new XMLHttpRequest();
  }
  catch(e1)
  {
    try						//IE6+瀏覽器
    {
      var XHR = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e2)
    {
      try					//IE5瀏覽器
      {
        var XHR = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e3)				//不支援Ajax
      {
        XHR = false;
      }
    }
  }
  return XHR;
}