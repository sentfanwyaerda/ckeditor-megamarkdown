MegaMarkDown Mark-up Manual
===========================

*also look at the [configuration of MegaMarkDown](mega-configuration.md)*

...

### Spaces Mapping
A single newline will result in a ``<br/>``, a double newline will instruct the end of and create a new paragraph ``<p></p>``.

### Standard Texts
A simple standard text should contain as less as posible mark-up. But sometimes you want to make it <strong>``*bold*``</strong>, or <em>``/italic/``</em>, or <u>``_underline_``</u>, or <s>``~strike-through~``</s>. These are IRC-styled. [MarkDown]() does define them as <strong>``**bold**``</strong>, or <em>``*italic*``</em>, and [GitHub-flavoured Markdown](https://help.github.com/articles/github-flavored-markdown) (GFM) gives <s>``~~strike-through~~``</s>. BBcode promotes it like <strong>``[b]bold[/b]``</strong>, or <em>``[i]italic[/i]``</em>, or <u>``[u]underline[/u]``</u>, or <s>``[s]strike-through[/s]``</s> following the html-style replacing ``<>`` with `[]`.

Only these styles will give conflicts, so you would have to configure which flavour to use. IRC-style by default.

### Links and Anchors
``[label](http://to.somewhe.re/else/)`` and ``[url=http://to.somewhe.re/else/]label[/url]`` (BBcode). Naked urls will also be turned into links.

### Tasks and Lists
In [TaskPaper]():

```
- finished task @done
- open task
```

In [GFM](https://help.github.com/articles/github-flavored-markdown):

```
- [x] finished task
- [ ] open task
```

### Fenced code blocks and syntax highlighting
It uses the GFM <code>```syntax</code>. With the optional *syntax* assigning the way to highlight the code.

### Multi-Lingual Content
*This notation is inspired upon [qTranslate](http://www.qianqin.de/qtranslate/).*


By its BBcode-variation:

```
[:en]The English text comes here[:nl]De Nederlandse tekst komt hier[:]
```

Or with its more "HTML-compliant" equivalent:

```
<!--:en-->The English text comes here<!--:nl-->De Nederlandse tekst komt hier<!--:-->
```

Both ``[:en]`` and ``<!--:en-->`` will automatically be closed by a new tag, or by end-tags ``[/:en]`` and ``<!--/:en-->``. The ``[:]`` can be configured as end-tag, or as *undefined*-language.

These will be parsed and placed like ``<span xml:lang="en">The English text comes here</span>``
