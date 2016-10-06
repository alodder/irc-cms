// JavaScript Document

function fadeEffect(elementID) {
	this.element = document.getElementById(elementID);
	this.level = 0;
	
	this.setOpacityLevel = function () {
		this.element.style.opacity = this.level;
		this.element.style.filter = "alpha(opacity=" + (this.level)*100 + ")";
	}
	
	this.setOpacityLevel();
	
	this.increaseOpacity = function () {
		var _self = this;
		this.level +=.3;
		if(this.level > 1)
		{
			this.level = 1;
		}
		this.setOpacityLevel();
		if(this.level < 1)
		{
			setTimeout(function(){
				_self.increaseOpacity();
			}, 100);
		}
	};
	
	this.increaseOpacity();
}

function fadeShow(elementID, parent)
{
	for(i=0; i<document.getElementById(parent).childNodes.length; i++)
	{
		if(document.getElementById(parent).childNodes.item(i).nodeType != 3)
			document.getElementById(parent).childNodes.item(i).style.display="none";
	}
	document.getElementById(elementID).style.display="block";
	fadeEffect(elementID);
}

function fadeMenu(elementID)
{
	if(document.getElementById(elementID).style.display!="block")
	{
		document.getElementById(elementID).style.display="block";
		fadeEffect(elementID);
	}
}
	
function slideEffect(elementID, action) {
	this.element = document.getElementById(elementID);
	var height = this.element.offsetHeight;
	
	this.setHeight = function () {
		if ((this.level <= 0) && (action == "contract"))
		{
			document.getElementById(elementID).style.height = height + 'px';
			document.getElementById(elementID).style.display = "none";
		}
		else {
			document.getElementById(elementID).style.height = this.level + 'px';
		}
	}
	
	this.increaseHeight = function () {
		var _self = this;
		this.level += 5;
		if(this.level >= height)
		{
			this.level = height;
		}
		this.setHeight();
		if(this.level < height)
		{
			setTimeout(function(){
				_self.increaseHeight();
			}, 10);
		}
	};
	
	this.decreaseHeight = function () {
		var _elf = this;
		this.level -=5;
		if(this.level <= 0)
		{
			this.level = 0;
		}
		this.setHeight();
		if(this.level > 0)
		{
			setTimeout(function(){
				_elf.decreaseHeight();
			}, 10);
		}
	};
	
	if (action == "contract")
	{
		this.level = height;
		this.setHeight();
		this.decreaseHeight();
	} else {
		this.level = 0;
		this.setHeight();
		this.increaseHeight();
	}
}

function showElement ( elementID) {
	if (document.getElementById(elementID).style.display == "block"){
		document.getElementById(elementID).style.display = "none"
	}
	else {
		document.getElementById(elementID).style.display = "block";
	}
}

function contractElement ( elementID) {
	if (document.getElementById(elementID).style.display == "block") {
		new slideEffect (elementID, 'contract');
	}
}

function expandElement ( elementID) {
	if (document.getElementById(elementID).style.display == "block") {
		document.getElementById(elementID).style.display = "none"
	}
	else {
		document.getElementById(elementID).style.display = "block";
		new slideEffect (elementID, 'expand');
	}
}