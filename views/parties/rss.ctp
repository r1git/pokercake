<rss version="2.0" xmlns:dc="http://purl.org/dc/elements/1.1/">
  <channel>
    <title>Ab Poker Tour</title>
    <link>http://yoursite/poker</link>
    <description>RSS Feed du Ab Poker Tour</description>
    <language>fr</language>
    <pubDate><?php echo date("D, j M Y H:i:s", gmmktime()) . ' GMT';?></pubDate>
    <?php foreach ($parties as $party): ?>
    <item>
      <title>Partie chez <?php echo $party['Joueur']['nom']; ?> le <?php echo $party['Party']['date']; ?></title>
      <link>http://yoursite/poker/index.php/parties/view/<?php echo $party['Party']['id']; ?></link>
      <description>
	<pre><?php $i=1; foreach ($party['Resultat'] as $key => $resultat): ?><?php echo $i."- ".$listenoms[$resultat['joueur_id']]." (".$resultat['score']." euros)\n"; ?><?php $i++; endforeach; ?></pre>
      </description>
    </item>
    <?php endforeach; ?>
  </channel>
</rss> 
