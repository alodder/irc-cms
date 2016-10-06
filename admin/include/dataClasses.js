/*
 * Data classes for javascript
 */

/*
 * Announcement post
 */
function announcement( newID, newHeading, newContent, newImage, newDate){
	this.ann_id = newID;
	this.ann_heading = newHeading;
	this.ann_content = newContent;
	this.image_id = newImage;
	this.date = new Date( newDate);
}

announcement.prototype.getSafeContent = function(){
	return escape( this.ann_content);
};

announcement.prototype.getID = function(){
	return this.ann_id;
};

announcement.prototype.print = function(){
	document.write( this.ann_heading);
};

announcement.prototype.printResult = function(){
	document.writeln( "<div class=\"announcement\" id=\"ann-"+this.ann_id+"\">");
	document.writeln( "<h2>"+this.ann_heading+" - "+this.ann_id+"</h2>");
	document.writeln( "<h3>"+this.date.toDateString()+"</h3>");
	document.writeln( "<p>"+this.ann_content+"</p>");
	document.writeln( "</div>");
};