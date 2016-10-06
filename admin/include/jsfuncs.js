// JS Functions
function getXMLDocument()
{
	var xDoc = null;
	if (document.implementation && document.implementation.createDocument){
		xDoc = document.implementation.createDocument("", "", null);
	} else if (typeof ActiveXObject != "undefined"){
		var msXmlAx = null;
		try{
			msXmlAx = new ActiveXObject("Msxml2.DOMDocument");
		} catch (e){
			msXmlAx = new ActiveXObject("Msxml.DOMDocument");
		}
		xDoc = msXmlAx;
	}
	if (xDoc==null || typeof xDoc.load=="undefined"){
		xDoc=null;
	}
	return xDoc;
}

function getXMLHTTPRequest()
{
	var xRequest=null;
	if (window.XMLHttpRequest) {
		xRequest=new XMLHttpRequest();
	}else if (typeof ActiveXObject != "undefined") {
		xRequest=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xRequest;
}

function getXMLHTTPRequest2()
{
	var xhr=null;
	if (window.XMLHttpRequest) {
	  xhr=new XMLHttpRequest();
	}else {
	  xhr=new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xhr;
}

function sendRequest(url, params, HttpMethod, elementId)
{
  if(!HttpMethod){
    HttpMethod="GET";
  }
  req = getXMLHTTPRequest();
  req.open(HttpMethod, url, false);
  req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  if (req){
    req.onreadystatechange = function()
    {
      var ready=req.readyState;
      var data=null;
      if(req.readyState == 4 && req.status == 200){
	data=req.responseText;
      } else if (req.readyState == 4 && req.status != 200){
	data="<div class=\"error\">Ready, but status "+req.status+"<div>";
      } else{
	data="<img src=\"images/loading.gif\" />Thinking...["+(4-ready)+"]";
      }
      display(data, elementId);
    }
    req.send(params);
  }
}

function getData(dataSource, divID) 
{ 
	var XMLHttpRequestObject = getXMLHTTPRequest();
	if(XMLHttpRequestObject) {
		var obj = document.getElementById(divID); 
		XMLHttpRequestObject.open("GET", dataSource);
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {
				obj.innerHTML = XMLHttpRequestObject.responseText;
			} else {
				obj.innerHTML = "<img src=\"images/loading.gif\" />Loading...";
			}
		}
		XMLHttpRequestObject.send(null);
	}
}

function unHide(elementID)
{
	var obj = document.getElementById(elementID);
	obj.style.display="block";
}

function closeWindow(elementID)
{
	var obj = document.getElementById(elementID);
	obj.style.display="none";
}

function postDataReturnText(url, data)
{
	var XMLHttpRequestObject = getXMLHTTPRequest();
	if(XMLHttpRequestObject){
		XMLHttpRequestObject.open("POST", url, false);
		XMLHttpRequestObject.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		XMLHttpRequestObject.setRequestHeader("Content-length", formData2QueryString(data).length);
		XMLHttpRequestObject.setRequestHeader("Connection", "close");
		XMLHttpRequestObject.onreadystatechange = function()
		{
			if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200){
				XMLHttpRequestObject.responseText;
			}
		}
		XMLHttpRequestObject.send(formData2QueryString(data));
	}
}

function formData2QueryString(form){
	var theFormElements = document.getElementById(form).elements;
	var queryString = "";//"?" + theFormElements.item(0).id + "=" + escape(theFormElements.item(0).value);
	for(var i=0; i<theFormElements.length; i++){
		queryString += "&" + theFormElements.item(i).id + "=" + escape(theFormElements.item(i).value);
	}
	return queryString;
}

function display(text, elementId)
{
	if(!elementId){
		elementId="palette";
	}
	document.getElementById(elementId).innerHTML = text;
}

function removeElement(elementId){
	var element = document.getElementById(elementId);
	element.parentNode.removeChild(element);
}