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
    <h2>The uzbl browser</h2>
    <p>Uzbl follows the UNIX philosophy - &quot;Write programs that do one thing and do it well. Write programs to work together. Write programs to handle text streams, because that is a universal interface.&quot;</p>
    <ul>
    <li>very minimal graphical interface. You only see what you need</li>
    <li>what is not browsing, is not in uzbl.  Things like url changing, loading/saving of bookmarks, saving history, downloads, ... are handled through <b>external</b> scripts that you write</li>
    <li>controllable through various means such as fifo and socket files, stdin, keyboard and more</li>
    <li>advanced, customizable keyboard interface with support for modes, modkeys, multichars, keywords, variable expansion etc. (if you don't understand this: it means you can tweak the interface to be vim-like, emacs-like or any-other-program-like)</li>
    <li>focus on plaintext storage for your data and configs in simple, parseable formats</li>
    <li>Uzbl keeps it simple, and puts <b>you</b> in charge.</li>
    </ul>
    <p>Uzbl is under heavy development.  No release has been made so far.  See the <a href="/get.php">Get uzbl</a> page</p>
  </div>
  
  <div id="news">
    <h2>Latest News</h2>
    <?php echo $news; ?>          
  </div>
