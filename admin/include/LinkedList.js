/*
 * Linked list in javascript!
*/

function node( newData){
	var next;
	var previous;
	this.data = newData;
}

node.prototype.getData = function(){
	return this.data;
};

node.prototype.setData = function( newData){
	this.data = newData;
};

node.prototype.getNext = function(){
	return this.next;
};

node.prototype.getPrevious = function(){
	return this.previous;
};

node.prototype.setNext = function( newNext){
	this.next = newNext;
};

node.prototype.setPrevious = function( newPrevious){
	this.previous = newPrevious;
};



function linkedList(){
	var head;
}

linkedList.prototype.getHead = function(){
	return this.head;
};

linkedList.prototype.setHead = function( newHead){
	this.head = newHead;
};

linkedList.prototype.add = function( newNode){
	newNode.setNext( this.getHead());
	if(this.getHead() != null)
		this.head.setPrevious(newNode);
	this.setHead( newNode);
	newNode.setPrevious(null);
};

linkedList.prototype.remove = function( aNode){
	if( aNode.getPrevious() != null){
		aNode.getPrevious().setNext( aNode.getNext());
	} else {
		this.setHead( aNode.getNext());
	}
	if( aNode.getNext() != null){
		aNode.getNext().setPrevious( aNode.getPrevious());
	}
};