/*
=====================================================================================================
Copyright (c) 2015 - Today, Treevea.
All rights reserved.


file : home.js
brief :  contains the home page's javascript code for dynamic contents generation
authors : Matthieu JABBOUR
version : 0.0
date : 2015/09/21


Further informations : www.treevea.com
=====================================================================================================
*/



//	Index numeriques seulement : pb de synchro entre users (delete / move)
//	Index associatifs seulement : pb de rangement (plus d'ordre)

//var socket = io.connect('http://127.0.0.1:8080', {query: 'page=' + window.location.pathname + '&cookie=' + document.cookie.split('PHPSESSID=')[1]});
var key = 0;
var contents = null;
var position = new Path();
var draggedElement = null;
var dropZone = null;
var pseudoDragged = null;
var navID = Math.round(Math.random() * 100000);

function fromJSON(obj)	{
	if(obj.class == 'Slide')	{
		return new Slide(obj.name);
	}
	else if(obj.class == 'Project')	{
		var contents = {};
		for(var item in obj.contents)	 {
			contents[item] = fromJSON(obj.contents[item]);
		}
		return new Project(obj.name, obj.image, contents);
	}
}

function updateView(index)	{

	var currentContent = contents;
	var projectsNames = {'.': currentContent.getName()};
	var path = position.get().split('.');
	var end = (index != undefined) ? index : path.length;
	position.clear();

	for(var i = 1; i < end; ++i)	{
		var content = currentContent.getContents()[path[i]];
		if(content != undefined)	{
			if(content.getClass() == 'Project')	{
				projectsNames[path[i]] = (content.getName());
				currentContent = content;
				position.add(path[i]);
			}
		}
		else	{
			break;
		}
	}
	window.clearTimeout(DragAndDrop.dragTimeout);	//	To avoid reference on an old DOM element that doesn't exist anymore
	main.refs.popup.setState({style: {display: 'none'}});
	main.refs.navBar.setState({parents: projectsNames});
	main.refs.contentsList.setState({contents: currentContent});
}



function update()	{
	if(main.refs.contentsList.state.contents != null)	{
		var grid = main.refs.contentsList.state.contents.getContents();
		React.findDOMNode(main.refs.contentsList).style.width = (window.innerWidth - 400) + 'px';
		var totalWidth = React.findDOMNode(main.refs.contentsList).offsetWidth;
		cols = Math.floor(totalWidth/w);
		rows = Math.ceil(grid.length/cols);
		s = Math.round((totalWidth - cols * w)/(cols + 1));


		var i = 0;
		var j = 0;
		for(var item in grid)	{
			if(!DragAndDrop.dragging || item != DragAndDrop.draggedElement.id)	{
				main.refs.contentsList.props.styles[item].top = (25 + h) * i + 25 + 'px';
				main.refs.contentsList.props.styles[item].left = (s + w) * j + s + 'px';
				var element = document.getElementById(item);
				if(element.style.left != main.refs.contentsList.props.styles[item].left || document.getElementById(item).style.top != main.refs.contentsList.props.styles[item].top)	{
					element.setAttribute('class', 'disabledContent');
					element.style.left = main.refs.contentsList.props.styles[item].left;
					element.style.top = main.refs.contentsList.props.styles[item].top;
					window.setTimeout((function(element) {
						return function()	{
							element.setAttribute('class', 'content');
						};
					})(element), 300);
				}
			}
			if(j < cols - 1)	{
				j++;
			}
			else	{
				i++;
				j = 0;
			}
		}
	}
}


/*
 *
 *	EVENTS HANDLERS
 *
 */
 /*
socket.on('contents', function(newContents)	{
	contents = fromJSON(newContents);
	updateView();
});
socket.on('data', function(data)	{
	var elem = document.createElement('div');
	elem.innerHTML = data;
	document.body.appendChild(elem);
});
*/
var xhr = null;



function request(first)	{
	if (xhr && xhr.readyState != 0) {
		xhr.abort();
	}

	xhr = new XMLHttpRequest();
	//encodeURIComponent
	//xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() {
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			//console.log(xhr.responseText);
			if(xhr.responseText != '')	{
				var newContents = (JSON.parse(xhr.responseText));
				contents = fromJSON(newContents);
				updateView();
			}
			window.setTimeout(request, 50);
		}
	};
	xhr.open("GET", "http://127.0.0.1:81/process?nav=" + navID);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send();
}



request(true);


function handleAddContent(position, type)	{
	var xhr = new XMLHttpRequest();
	//encodeURIComponent
	xhr.onreadystatechange = function() {
		//console.log(xhr.responseText);
		/*if (xhr && xhr.readyState != 0) {
			xhr.abort();
		}*/

		/*if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();
		}*/
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			//console.log(xhr.responseText);
			/*var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();*/
			//window.setTimeout(request, 1000);
		}
	};
	xhr.open("POST", "http://127.0.0.1:81/process");
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('type=' + type + '&position=' + position + '&action=addContent&formToken=' + document.getElementById('token').getAttribute('value'));
	//return socket.emit('addContent', position, type);
}


function handleRemoveContent(position)	{
	var xhr = new XMLHttpRequest();
	//encodeURIComponent
	xhr.onreadystatechange = function() {
		//console.log(xhr.responseText);
		/*if (xhr && xhr.readyState != 0) {
			xhr.abort();
		}*/

		/*if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();
		}*/
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			//console.log(xhr.responseText);
			/*var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();*/
			//window.setTimeout(request, 1000);
		}
	};
	xhr.open("POST", "http://127.0.0.1:81/process");
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('position=' + position + '&action=removeContent&formToken=' + document.getElementById('token').getAttribute('value'));
}


function handleDuplicateContent(position)	{
	var xhr = new XMLHttpRequest();
	//encodeURIComponent
	xhr.onreadystatechange = function() {
		//console.log(xhr.responseText);
		/*if (xhr && xhr.readyState != 0) {
			xhr.abort();
		}*/

		/*if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();
		}*/
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			//console.log(xhr.responseText);
			/*var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();*/
			//window.setTimeout(request, 1000);
		}
	};
	xhr.open("POST", "http://127.0.0.1:81/process");
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('position=' + position + '&action=duplicateContent&formToken=' + document.getElementById('token').getAttribute('value'));
}


function handleEditContent(position, informations)	{
  



	 var reader  = new FileReader();

	  reader.onloadend = function () {
	    //informations.img = reader.result;
		//console.log(position);
		//console.log(informations.img);
		var obj = new FormData();
		obj.append('afile', informations.img);
		obj.append('position', position);
		obj.append('name', informations.name);
		obj.append('action', 'editContent');
		var xhr = new XMLHttpRequest();
		//encodeURIComponent
		xhr.onreadystatechange = function() {
			if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
				/*console.log(xhr.responseText);
				var newContents = (JSON.parse(xhr.responseText));
				contents = fromJSON(newContents);
				updateView();*/
				//window.setTimeout(request, 1000);
			}
		};
		xhr.open("POST", "http://127.0.0.1:81/process");
		xhr.send(obj);
	  }

	  if (informations.img) {
	    reader.readAsBinaryString(informations.img);
	  }




	//return socket.emit('editContent', position, informations);
}


function handleMoveContent(from, to)	{
	var xhr = new XMLHttpRequest();
	//encodeURIComponent
	xhr.onreadystatechange = function() {
		//console.log(xhr.responseText);
		/*if (xhr && xhr.readyState != 0) {
			xhr.abort();
		}*/

		/*if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();
		}*/
		if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
			//console.log(xhr.responseText);
			/*var newContents = (JSON.parse(xhr.responseText));
			contents = fromJSON(newContents);
			updateView();*/
			//window.setTimeout(request, 1000);
		}
	};
	xhr.open("POST", "http://127.0.0.1:81/process");
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('from=' + from + '&to=' + to + '&action=moveContent&formToken=' + document.getElementById('token').getAttribute('value'));
}







var Popup = React.createClass({

	getInitialState: function()	{
		return {style: {}, id: null, value: 'yo'};
	},


	handleCancel: function(event)	{
		this.setState({style: {display: 'none'}, id: null});
	},


	handleOk: function(event)	{
		handleEditContent(position.tempAdd(this.state.id), {name: this.state.value, img: this.props.file});
		event.preventDefault();
	},


	handleDrop: function(event)	{
		var elem = event.target;
		event.preventDefault();
		event.stopPropagation();
		this.props.file  = event.dataTransfer.files[0];
	},


	handleDragOver: function(event)	{
		event.preventDefault();
	},


	handleChange: function(event)	{
		this.props.file = event.target.files[0];
	},


	handleKey: function(event)	{
		this.setState({value: event.target.value});
	},

	handleClick: function(event)	{
		event.target.focus();
	},


	render: function()	{

		return (
			<form id="test" className="popup" style={this.state.style}>
				<input type="file" id="input" onChange={this.handleChange}/>
				<input type="text" id="newName" onClick={this.handleClick} onChange={this.handleKey} value={this.state.value}/>
				<div className="dropZone" onDrop={this.handleDrop} onDragOver={this.handleDragOver}></div>
				<button onClick={this.handleOk}>{'ok'}</button>
				<button onClick={this.handleCancel}>{'cancel'}</button>
			</form>
		);
	}

});


var Main = React.createClass({

	render: function()	{

		return (
			<section>
				<ContentsList ref="contentsList" styles={{}} />
				<NavBar ref="navBar" />
				<Popup ref="popup"/>
			</section>
		);
	}

});

/*
React.render(
	<ToolBar />,
	document.getElementById('leftMenu').getElementsByClassName('contentMenu')[0]
);*/

var main = React.render(
	<Main />,
	document.getElementsByTagName('main')[0]
);

DragAndDrop.dragArea = React.findDOMNode(main.refs.contentsList);
document.body.addEventListener('mousedown', function(event)	{
	event.preventDefault();
});

document.body.addEventListener('mouseup', function(event)	{
	if(event.target == document.body)	{
		DragAndDrop.stopDrag();
		update();
	}
});

window.onresize = function(ev)	{
	update();
}

/*
document.body.addEventListener('click', function(event)	{
	document.getElementById('leftMenu').style.left = '-200px';
	document.getElementById('rightMenu').style.right = '-200px';
	LeftMenu.extended = false;
	RightMenu.extended = false;
})*/