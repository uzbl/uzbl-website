<div id="navigation">
   <ul>
     <?php echo $navigation; ?>
   </ul>
</div>

<div id="right">
  <div id="commits">
    <h2>Recent Commits</h2>
    <ul>
      <?php echo $recentcommits; ?>
      <li><a href="/commits.php">More&hellip;</a></li>
    </ul>
  </div>
  
  <div id="branches">
    <h2>Branches</h2>
    <ul>
      <li>Dieterbe
        <ol>
          <li><a href="http://github.com/Dieterbe/uzbl/tree/master">master</a></li>
          <li><a href="http://github.com/Dieterbe/uzbl/tree/experimental">experimental</a></li>
      </ol></li>
      <li>Anydot
        <ol>
          <li><a href="http://github.com/anydot/uzbl/tree/experimental">experimental</a></li>
      </ol></li>
      <li>Barrucadu
        <ol>
          <li><a href="http://github.com/Barrucadu/uzbl/tree/experimental">experimental</a></li>
      </ol></li>
      <li>Dusanx
        <ol>
          <li><a href="http://github.com/dusanx/uzbl/tree/master">master</a></li>
      </ol></li>
      <li>Rob M
        <ol>
          <li><a href="http://github.com/robm/uzbl/tree/experimental">experimental</a></li>
      </ol></li>
    </ul>
  </div>
</div>

<div id="left">
  <div id="about">
    <h2>The uzbl browser&hellip;</h2>
    <p>&hellip;a keyboard controlled (modal vim-like bindings, or with modifier keys) browser based on Webkit.</p>
    <p>very minimal interface.  No unnecessary interface elements</p>
    <p>controllable through a FIFO and with external scripts.</p>
    <p>what is not browsing, is not in uzbl.  Things like url changing, loading/saving of bookmarks, saving history,.. are handled through <b>external</b> scripts that you write</p>
    <p>Uzbl keeps it simple, and puts <b>you</b> in charge.</p>
    <p>Uzbl follows the UNIX philosophy - &quot;Write programs that do one thing and do it well. Write programs to work together. Write programs to handle text streams, because that is a universal interface.&quot;</p>
    <p>Uzbl is under heavy development at the moment and shouldn't really be used as your main browser. Unless you're daring of course. The latest 'stable' branch is located in Dieterbe's master branch, and the latest development version in his experimental branch. You can, however, run code from the other developers branches, it just might not work.</p>
    <p>You can find us in IRC at irc.freenode.net, in channel #uzbl.</p>
  </div>
  
  <div id="news">
    <h2>Latest News</h2>
    <?php echo $news; ?>          
  </div>
</div>
