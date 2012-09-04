<?php

namespace Markdown;

/**
 * Markdown translator helper to produce HTML code.
 *
 * @author Héctor Ramón Jiménez
 */
class Helper
{	
	public function __construct() {
		
	}
	
	public function translate($markdown)
	{
		require_once(__DIR__ . '/markdown.php');
		
		return Markdown($markdown);
	}
	
	public function translateSimple($markdown)
	{
		if(empty($markdown))
			return null;
		
		$markdown = str_replace("\r\n", "\n", $markdown);

		return '<p>'.
			preg_replace(
					array("/([\n]{2,})/", "/([^>])\n([^<])/", '/\[([^\]]+)\]\(([^\)]+)\)/', '/\*\*([^\*]+)\*\*/',
						'/__([^_]+)__/', '/\*([^\*]+)\*/', '/_([^_]+)_/'),
					array("</p>\n<p>", "\\1<br />\n\\2", '<a href="\\2">\\1</a>', '<strong>\\1</strong>',
						'<strong>\\1</strong>', '<em>\\1</em>', '<em>\\1</em>'),
					htmlspecialchars($markdown, ENT_QUOTES)
			).
			'</p>';
	}
}
