/*
=====================================================================================================
Copyright (c) 2015 - Today, Treevea.
All rights reserved.


file : dashboard.js
brief :  contains the dashboard page's javascript code for dynamic contents generation
authors : Matthieu JABBOUR
version : 0.0
date : 2015/09/21


Further informations : www.treevea.com
=====================================================================================================
*/



var socket = io.connect('http://localhost:8080', {query: 'page=' + window.location.pathname});
var element = null;


socket.on('userInformations', function(newUserInformations)	{
	form.setState({userInformations: newUserInformations});
});






var Field = React.createClass({


	getInitialState: function() {
	    return {value: ''};
	},


	handleClick: function(event)	{
		if(element != null)	{
			element.disabled = true;
		}
		element = event.target;
		event.target.disabled = false;
	},


	handleChange: function(event)	{
		this.props.value = event.target.value;
		this.forceUpdate();
		socket.emit('changeUserInformations', this.props.title, this.props.value);
	},


	render: function()	{
		var value = this.props.value;
		return (
			<div>
				<h3>{this.props.title}</h3>
				<input type="text" disabled={true} onClick={this.handleClick} onChange={this.handleChange} value={value} />
			</div>
		);
	}

});




var Form = React.createClass({

	getInitialState: function() {
	    return {userInformations: {
	    	name: '',
	    	firstName: '',
	    	mail: '',
	    	phone: '',
	    	position: ''
	    }};
	},


	render: function()	{		
		var comps = [];
		for(var item in this.state.userInformations)	{
			comps.push(<Field title={item} value={this.state.userInformations[item]}/>);
		}

		return (
			<form> 
				{comps}
			</form>
		);
	}

});






var form = React.render(
	<Form />,
	document.getElementsByTagName('main')[0]
);


document.body.addEventListener('click', function(event)	{
	if(element != null)	{
		element.disabled = true;
		element = null;
	}
});