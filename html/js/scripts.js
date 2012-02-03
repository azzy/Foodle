function add_field()
{
var div1 = document.createElement('div');
div1.innerHTML = document.getElementById('template').innerHTML;
document.getElementById('emails-form').appendChild(div1);
}