<h1>
    <span><?php print $request["Query"]["view"];?></span>
    <span><?php print $request["Query"]["action"];?></span>
    [<span><?php print $request["Method"];?></span>]
</h1>
<pre><?php print_r($request); ?></pre>