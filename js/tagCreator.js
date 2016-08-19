/*
Copyright (c) <year> <copyright holders>
Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/
(function(a)
{
	/*
	*	Create function for jQuery
	*/
	a.tagCreator = function(tag)
	{
		return create(tag);
	};

	/*
	*	Append tag object inside the element
	*/
	a.fn.tagCreator = function(tag, callback)
	{
		$(this).append(create(tag));

		if(callback)
			callback();
	};

	/*
	*	Parse tag object
	*/
	function create(obj)
	{
		var tagObj = '';

		if(typeof obj === 'object')
		{
			for(tag in obj)
				tagObj += createTag(tag, obj[tag]);
		}

		if(typeof obj === 'string')
			tagObj = createTag(obj);

		return tagObj;
	};

	/*
	*	Create tag element
	*/
	function createTag(obj, attr)
	{
		var tag = '';
		var single = isSingle(obj);
		var content = '';

		if(attr)
		{
			tag += '<' + obj;

			for(e in attr)
			{
				if(e != 'content')
				{
					if(e == 'style')
						tag += ' ' + e + '="' + parseStyle(attr[e]) + '"';
						
					else
						tag += ' ' + e + '="' + attr[e] + '"';
				}

				else
					content += attr[e];
			}

			tag += '>';
			tag += content;

			if(!single)
				tag += '</' + obj + '>';
		}

		else
		{
			if(single)
				tag += '<' + obj + '>';

			else
			{
				tag += '<' + obj + '>';
				tag += '</' + obj + '>';
			}
		}

		return tag;
	}

	/*
	*	Check if the provided tag is single tag
	*/
	function isSingle(tag)
	{
		var single = ['input', 'base', 'br', 'hr', 'img', 'keygen', 'link', 'menuitem', 'meta', 'source', 'track'];

		if(single.indexOf(tag) != -1)
			return true;

		return false;
	}

	/*
	*	Parse style object
	*/
	function parseStyle(obj)
	{
		var style = '';

		for(rule in obj)
		{
			style += rule + ':' + obj[rule] + ';';
		}

		return style;
	}
})(window.jQuery);