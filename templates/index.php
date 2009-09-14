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
      <li>Official
        <ol>
          <li><a href="http://github.com/Dieterbe/uzbl/tree/master">master</a></li>
          <li><a href="http://github.com/Dieterbe/uzbl/tree/experimental">experimental</a></li>
      </ol></li>
      <li>Community
        <ol>
          <li><a href="http://github.com/Dieterbe/uzbl/network">many repos @ github</a></li>
          <li><a href="http://www.google.be/search?&q=google+uzbl+git+-github">some repos not @ github</a></li>
          <li><a href="http://github.com/search?q=uzbl">github search</a>
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
    <li>what is not browsing, is not in uzbl.  Things like url changing, loading/saving of bookmarks, saving history, downloads, ... are handled through <strong>external</strong> scripts that you write</li>
    <li>controllable through various means such as fifo and socket files, stdin, keyboard and more</li>
    <li>advanced, customizable keyboard interface with support for modes, modkeys, multichars, variables (keywords) etc. (eg you can tweak the interface to be vim-like, emacs-like or any-other-program-like)</li>
    <li>focus on plaintext storage for your data and configs in simple, parseable formats</li>
    <li>Uzbl keeps it simple, and puts <strong>you</strong> in charge.</li>
    </ul>
    <p>Uzbl is under heavy development and should be considered alpha.  See the <a href="/get.php">Get uzbl</a> page</p>
  </div>
  
  <div id="news">
    <h2>Latest News</h2>
    <?php echo $news; ?>          
  </div>
</div>
