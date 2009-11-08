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
    <h2>The uzbl web interface tools</h2>
    <p>Uzbl follows the UNIX philosophy - &quot;Write programs that do one thing and do it well. Write programs to work together. Write programs to handle text streams, because that is a universal interface.&quot;
    Uzbl comes in different flavors:</p>
    <ul>
      <li>uzbl-core: main component meant for integration with other tools and scripts
        <ul>
          <li>Uses WebkitGtk+ for rendering, network interaction (libsoup).  Css, javascript, plugin support etc come for free</li>
          <li>Provides interfaces to get data in (commands/configuration) and out (events): stdin/stdout/fifo/unix sockets</li>
          <li>You see a webkit view and (optionally) a statusbar which gets popuplated externally</li>
          <li>No built-in means for url changing, loading/saving of bookmarks, saving history, keybinds, downloads, ...</li>
          <li>Extra functionality: many sample scripts come with it, on <a href="http://www.uzbl.org/wiki/scripts">uzbl wiki</a> or write them yourself</li>
          <li>Entire configuration/state can be changed at runtime</li>
          <li>Uzbl keeps it simple, and puts <strong>you</strong> in charge.</li>
        </ul>
      </li>
      <li>uzbl-browser: a complete browser experience based on uzbl-core
        <ul>
          <li>Uses a set of scripts (mostly python) that will fit most people, so things work out of the box.  Yet plenty of room for customisation</li>
          <li>Brings everything you expect: url changing, history, downloads, form filling, link navigation, cookies, event management etc</li>
          <li>Advanced, customizable keyboard interface with support for modes, modkeys, multichars, variables (keywords) etc. (eg you can tweak the interface to be vim-like, emacs-like or any-other-program-like)</li>
          <li>Adequate default configuration</li>
          <li>Focus on plaintext storage for your data and configs in simple, parseable formats and adherence to the xdg basedir spec</li>
          <li>Visually, similar to uzbl-core except that the statusbar contains useful things.  One window per webpage</li>
        </ul>
      </li>
      <li>uzbl-tabbed: wraps around uzbl-browser and multiplexes it
        <ul>
          <li>Spawns one window containing multiple tabs, each tab containing a full embedded uzbl-browser</li>
          <li>Ideal as a quick and simple solution to manage multiple uzbl-browser instances without getting lost</li>
        </ul>
      </li>
    </ul>
    <p>Uzbl is under heavy development and should be considered alpha.  See the <a href="/get.php">Get uzbl</a> page</p>
  </div>
  
  <div id="news">
    <h2>Latest News</h2>
    <?php echo $news; ?>          
  </div>
</div>
