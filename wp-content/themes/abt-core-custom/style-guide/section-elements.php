<?php
	$theme_dir = get_stylesheet_directory_uri();
?>

<section class="section base-elements" data-content="elements">
	<div class="wrapper">
		<h1 class="title">Base Elements</h1>
		
		<article class="component">
			<h2 class="title">Paragraph</h2>
			<p class="description">The p element is one of the most commonly used building blocks of HTML.</p>
			<div class="preview">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam egestas odio tortor, sed vehicula nunc lobortis rutrum. Cras ultrices luctus purus non malesuada. Morbi accumsan, justo ut venenatis aliquet, risus elit sollicitudin tellus, eu vestibulum velit odio a justo.</p>
			</div>
			<pre><code class="language-markup">
&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam egestas odio tortor, sed vehicula nunc lobortis rutrum. Cras ultrices luctus purus non malesuada. Morbi accumsan, justo ut venenatis aliquet, risus elit sollicitudin tellus, eu vestibulum velit odio a justo.&lt;/p&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Links</h2>
			<p class="description">The a element is usually referred to as a link.</p>
			<div class="preview">
				<a href="#">This is a default link</a>
			</div>
			<pre><code class="language-markup">
&lt;a href=&quot;#&quot;&gt;This is a default link&lt;/a&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Blockquote</h2>
			<p class="description">The blockquote element is a mechanism for marking up a block of text quoted from a person or another document or source.</p>
			<div class="preview">
				<blockquote>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam egestas odio tortor, sed vehicula nunc lobortis rutrum. Cras ultrices luctus purus non malesuada. Morbi accumsan, justo ut venenatis aliquet, risus elit sollicitudin tellus, eu vestibulum velit odio a justo.</blockquote>
			</div>
			<pre><code class="language-markup">
&lt;blockquote&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam egestas odio tortor, sed vehicula nunc lobortis rutrum. Cras ultrices luctus purus non malesuada. Morbi accumsan, justo ut venenatis aliquet, risus elit sollicitudin tellus, eu vestibulum velit odio a justo.&lt;/blockquote&gt;
			</code></pre>
		</article>
		
		<article class="component">
			<h2 class="title">Line Rule</h2>
			<p class="description">The hr element creates in the document a highly visible break that renders as a slim horizontal line running the width of the area to which it’s applied.</p>
			<div class="preview">
				<hr>
			</div>
			<pre><code class="language-markup">
&lt;hr&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">List - Unordered</h2>
			<p class="description">The ul element, the name for which is an abbreviation of unordered list, is used to group a collection of items together in a list, but in a way that doesn’t suggest an order of precedence or importance.</p>
			<div class="preview">
				<ul>
					<li>This is a list item in an unordered list</li>
					<li>An unordered list is a list in which the sequence of items is not important. Sometimes, an unordered list is a bulleted list. And this is a long list item in an unordered list that can wrap onto a new line. </li>
					<li>
						Lists can be nested inside of each other
						<ul>
							<li>This is a nested list item</li>
							<li>This is another nested list item in an unordered list</li>
						</ul>
					</li>
					<li>This is the last list item</li>
				</ul>
			</div>
			<pre><code class="language-markup">
&lt;ul&gt;
	&lt;li&gt;This is a list item in an unordered list&lt;/li&gt;
	&lt;li&gt;An unordered list is a list in which the sequence of items is not important. Sometimes, an unordered list is a bulleted list. And this is a long list item in an unordered list that can wrap onto a new line.&lt;/li&gt;
	&lt;li&gt;
		Lists can be nested inside of each other
		&lt;ul&gt;
			&lt;li&gt;This is a nested list item&lt;/li&gt;
			&lt;li&gt;This is another nested list item in an unordered list&lt;/li&gt;
		&lt;/ul&gt;
	&lt;/li&gt;
	&lt;li&gt;This is the last list item&lt;/li&gt;
&lt;/ul&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">List - Ordered</h2>
			<p class="description">The ol element is similar to the ul element in that it’s used to group a collection of items together in a list.</p>
			<div class="preview">
				<ol>
					<li>This is a list item in an ordered list</li>
					<li>An ordered list is a list in which the sequence of items is important. An ordered list does not necessarily contain sequence characters.</li>
					<li>
						Lists can be nested inside of each other
						<ol>
							<li>This is a nested list item</li>
							<li>This is another nested list item in an ordered list</li>
						</ol>
					</li>
					<li>This is the last list item</li>
				</ol>
			</div>
			<pre><code class="language-markup">
&lt;ol&gt;
	&lt;li&gt;This is a list item in an ordered list&lt;/li&gt;
	&lt;li&gt;An ordered list is a list in which the sequence of items is important. An ordered list does not necessarily contain sequence characters.&lt;/li&gt;
	&lt;li&gt;
		Lists can be nested inside of each other
		&lt;ol&gt;
			&lt;li&gt;This is a nested list item&lt;/li&gt;
			&lt;li&gt;This is another nested list item in an ordered list&lt;/li&gt;
		&lt;/ol&gt;
	&lt;/li&gt;
	&lt;li&gt;This is the last list item&lt;/li&gt;
&lt;/ol&gt;
			</code></pre>
		</article>
		
		<article class="component">
			<h2 class="title">List - Definition</h2>
			<p class="description">If you want to list a series of items that essentially have a title and a description of some kind (that is, each item has two parts), use the definition list dl element.</p>
			<div class="preview">
				<dl>
					<dt>Definition List</dt>
					<dd>A number of connected items or names written or printed consecutively, typically one below the other.</dd>
					<dt>This is a term.</dt>
					<dd>This is the definition of that term, which both live in a dl.</dd>
					<dt>Here is another term.</dt>
					<dd>And it gets a definition too, which is this line.</dd>
					<dt>Here is term that shares a definition with the term below.</dt>
					<dd>And it gets a definition too, which is this line.</dd>
				</dl>
			</div>
			<pre><code class="language-markup">
&lt;dl&gt;
	&lt;dt&gt;Definition List&lt;/dt&gt;
	&lt;dd&gt;A number of connected items or names written or printed consecutively, typically one below the other.&lt;/dd&gt;
	&lt;dt&gt;This is a term.&lt;/dt&gt;
	&lt;dd&gt;This is the definition of that term, which both live in a dl.&lt;/dd&gt;
	&lt;dt&gt;Here is another term.&lt;/dt&gt;
	&lt;dd&gt;And it gets a definition too, which is this line.&lt;/dd&gt;
	&lt;dt&gt;Here is term that shares a definition with the term below.&lt;/dt&gt;
	&lt;dd&gt;And it gets a definition too, which is this line.&lt;/dd&gt;
&lt;/dl&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Inputs</h2>
			<p class="description">Common form element that allows users to enter data.</p>
			<div class="preview">
				<input type="text" placeholder="Text Input" />
				<!-- <input type="email" placeholder="Email Input" /> -->
			</div>
			<pre><code class="language-markup">
&lt;input type=&quot;text&quot; placeholder=&quot;Text Input&quot; /&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Checkboxes</h2>
			<p class="description">Specific type of input that allows users to select multiple options for a particular label.</p>
			<div class="preview">
				<div class="checkboxes">				
					<fieldset>
						<legend><span>Choose an option (check all that apply):</span></legend>
						<ul>
							<li class="field">
								<input id="checkbox-option-option1" type="checkbox" name="checkbox-option" />
								<label for="checkbox-option-option1">Option 1</label>
							</li>
							<li class="field">
								<input id="checkbox-option-option2" type="checkbox" name="checkbox-option" />
								<label for="checkbox-option-option2">Option 2</label>
							</li>
							<li class="field">
								<input id="checkbox-option-option3" type="checkbox" name="checkbox-option" />
								<label for="checkbox-option-option3">Option 3</label>
							</li>
						</ul>
					</fieldset>
				</div>
			</div>
			<pre><code class="language-markup">
&lt;fieldset&gt;
	&lt;legend&gt;&lt;span&gt;Choose an option (check all that apply):&lt;/span&gt;&lt;/legend&gt;
	&lt;ul&gt;
		&lt;li class=&quot;field&quot;&gt;
			&lt;input id=&quot;checkbox-option-option1&quot; type=&quot;checkbox&quot; name=&quot;checkbox-option&quot; /&gt;
			&lt;label for=&quot;checkbox-option-option1&quot;&gt;Option 1&lt;/label&gt;
		&lt;/li&gt;
		&lt;li class=&quot;field&quot;&gt;
			&lt;input id=&quot;checkbox-option-option2&quot; type=&quot;checkbox&quot; name=&quot;checkbox-option&quot; /&gt;
			&lt;label for=&quot;checkbox-option-option2&quot;&gt;Option 2&lt;/label&gt;
		&lt;/li&gt;
		&lt;li class=&quot;field&quot;&gt;
			&lt;input id=&quot;checkbox-option-option3&quot; type=&quot;checkbox&quot; name=&quot;checkbox-option&quot; /&gt;
			&lt;label for=&quot;checkbox-option-option3&quot;&gt;Option 3&lt;/label&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
&lt;/fieldset&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Radios</h2>
			<p class="description">Specific type of input that allows users to select a specific option for a particular label.</p>
			<div class="preview">
				<div class="radios">				
					<fieldset>
						<legend><span>Choose an option:</span></legend>
						<ul>
							<li class="field">
								<input id="radio-option-option1" type="radio" name="radio-option" />
								<label for="radio-option-option1">Option 1</label>
							</li>
							<li class="field">
								<input id="radio-option-option2" type="radio" name="radio-option" />
								<label for="radio-option-option2">Option 2</label>
							</li>
							<li class="field">
								<input id="radio-option-option3" type="radio" name="radio-option" />
								<label for="radio-option-option3">Option 3</label>
							</li>
						</ul>
					</fieldset>
				</div>
			</div>
			<pre><code class="language-markup">
&lt;fieldset&gt;
	&lt;legend&gt;&lt;span&gt;Choose an option:&lt;/span&gt;&lt;/legend&gt;
	&lt;ul&gt;
		&lt;li class=&quot;field&quot;&gt;
			&lt;input id=&quot;radio-option-option1&quot; type=&quot;radio&quot; name=&quot;radio-option&quot; /&gt;
			&lt;label for=&quot;radio-option-option1&quot;&gt;Option 1&lt;/label&gt;
		&lt;/li&gt;
		&lt;li class=&quot;field&quot;&gt;
			&lt;input id=&quot;radio-option-option2&quot; type=&quot;radio&quot; name=&quot;radio-option&quot; /&gt;
			&lt;label for=&quot;radio-option-option2&quot;&gt;Option 2&lt;/label&gt;
		&lt;/li&gt;
		&lt;li class=&quot;field&quot;&gt;
			&lt;input id=&quot;radio-option-option3&quot; type=&quot;radio&quot; name=&quot;radio-option&quot; /&gt;
			&lt;label for=&quot;radio-option-option3&quot;&gt;Option 3&lt;/label&gt;
		&lt;/li&gt;
	&lt;/ul&gt;
&lt;/fieldset&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Buttons</h2>
			<p class="description">A common element that allows users to interact with an object, or perhaps link to something.</p>
			<div class="preview">
				<button class="primary">Primary Button</button>				
				<a class="button primary" href="#">Primary Button</a>
				<input class="primary" type="submit" value="Primary Button" />
				<br />
				<br />
				<button class="secondary">Secondary Button</button>
				<a class="button secondary" href="#">Secondary Button</a>
				<input class="secondary" type="submit" value="Secondary Button" />
				<br />
				<br />
				<button class="ghost">Ghost Button</button>
				<a class="button ghost" href="#">Ghost Button</a>
				<input class="ghost" type="submit" value="Ghost Button" />
			</div>
			<pre><code class="language-markup">
&lt;button class=&quot;primary&quot;&gt;Primary Button&lt;/button&gt;
&lt;button class=&quot;secondary&quot;&gt;Secondary Button&lt;/button&gt;
&lt;button class=&quot;ghost&quot;&gt;Ghost Button&lt;/button&gt;

&lt;a class=&quot;button primary&quot; href=&quot;#&quot;&gt;Primary Button&lt;/a&gt;
&lt;a class=&quot;button secondary&quot; href=&quot;#&quot;&gt;Secondary Button&lt;/a&gt;
&lt;a class=&quot;button ghost&quot; href=&quot;#&quot;&gt;Ghost Button&lt;/a&gt;

&lt;input class=&quot;primary&quot; type=&quot;submit&quot; value=&quot;Primary Button&quot; /&gt;
&lt;input class=&quot;secondary&quot; type=&quot;submit&quot; value=&quot;Secondary Button&quot; /&gt;
&lt;input class=&quot;ghost&quot; type=&quot;submit&quot; value=&quot;Ghost Button&quot; /&gt;
			</code></pre>
		</article>

		<article class="component">
			<h2 class="title">Table</h2>
			<p class="description">Table markup is used for presenting data in a grid-like fashion, not for the purposes of laying out a web page, or the sections within a web page.</p>
			<div class="preview">
				<table>
					<thead>
						<tr>
							<th>Table Heading 1</th>
							<th>Table Heading 2</th>
							<th>Table Heading 3</th>
							<th>Table Heading 4</th>
							<th>Table Heading 5</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Table Footer 1</th>
							<th>Table Footer 2</th>
							<th>Table Footer 3</th>
							<th>Table Footer 4</th>
							<th>Table Footer 5</th>
						</tr>
					</tfoot>
					<tbody>
					<tr>
						<td>Table Cell 1</td>
						<td>Table Cell 2</td>
						<td>Table Cell 3</td>
						<td>Table Cell 4</td>
						<td>Table Cell 5</td>
					</tr>
					<tr>
						<td>Table Cell 1</td>
						<td>Table Cell 2</td>
						<td>Table Cell 3</td>
						<td>Table Cell 4</td>
						<td>Table Cell 5</td>
					</tr>
					<tr>
						<td>Table Cell 1</td>
						<td>Table Cell 2</td>
						<td>Table Cell 3</td>
						<td>Table Cell 4</td>
						<td>Table Cell 5</td>
					</tr>
					<tr>
						<td>Table Cell 1</td>
						<td>Table Cell 2</td>
						<td>Table Cell 3</td>
						<td>Table Cell 4</td>
						<td>Table Cell 5</td>
					</tr>
					</tbody>
				</table>
			</div>
			<pre><code class="language-markup">
&lt;table&gt;
	&lt;thead&gt;
		&lt;tr&gt;
			&lt;th&gt;Table Heading 1&lt;/th&gt;
			&lt;th&gt;Table Heading 2&lt;/th&gt;
			&lt;th&gt;Table Heading 3&lt;/th&gt;
			&lt;th&gt;Table Heading 4&lt;/th&gt;
			&lt;th&gt;Table Heading 5&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/thead&gt;
	&lt;tfoot&gt;
		&lt;tr&gt;
			&lt;th&gt;Table Footer 1&lt;/th&gt;
			&lt;th&gt;Table Footer 2&lt;/th&gt;
			&lt;th&gt;Table Footer 3&lt;/th&gt;
			&lt;th&gt;Table Footer 4&lt;/th&gt;
			&lt;th&gt;Table Footer 5&lt;/th&gt;
		&lt;/tr&gt;
	&lt;/tfoot&gt;
	&lt;tbody&gt;
	&lt;tr&gt;
		&lt;td&gt;Table Cell 1&lt;/td&gt;
		&lt;td&gt;Table Cell 2&lt;/td&gt;
		&lt;td&gt;Table Cell 3&lt;/td&gt;
		&lt;td&gt;Table Cell 4&lt;/td&gt;
		&lt;td&gt;Table Cell 5&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;Table Cell 1&lt;/td&gt;
		&lt;td&gt;Table Cell 2&lt;/td&gt;
		&lt;td&gt;Table Cell 3&lt;/td&gt;
		&lt;td&gt;Table Cell 4&lt;/td&gt;
		&lt;td&gt;Table Cell 5&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;Table Cell 1&lt;/td&gt;
		&lt;td&gt;Table Cell 2&lt;/td&gt;
		&lt;td&gt;Table Cell 3&lt;/td&gt;
		&lt;td&gt;Table Cell 4&lt;/td&gt;
		&lt;td&gt;Table Cell 5&lt;/td&gt;
	&lt;/tr&gt;
	&lt;tr&gt;
		&lt;td&gt;Table Cell 1&lt;/td&gt;
		&lt;td&gt;Table Cell 2&lt;/td&gt;
		&lt;td&gt;Table Cell 3&lt;/td&gt;
		&lt;td&gt;Table Cell 4&lt;/td&gt;
		&lt;td&gt;Table Cell 5&lt;/td&gt;
	&lt;/tr&gt;
	&lt;/tbody&gt;
&lt;/table&gt;
			</code></pre>
		</article>
	</div>
</section>