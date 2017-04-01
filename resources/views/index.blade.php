@extends('layouts.master')
@section('title', 'This Week')

@section('content')
<div class="container-fluid">
  <div class="row">
    <header class="col-xs-12 col-md-4">
      <h1>CS Weekly</h1>
      <p>Computer Science Weekly is an enewsletter distributed every week to Computer Science faculty, staff and students.</p>
      <h3>Upcoming Events</h3>
      <ul class="upcoming">
        <span class="udate">Thursday March 30, 2017</span>
        <li><span class="udatetime">6pm, Fiedler 1107</span> | Google Tech Talk</li>
      </ul>
    </header>
    <div class="col-xs-12 col-md-8 news">
      <ul class="news-nav">
        <li><span class="notification">2</span> <a href="#general">General Announcements</a></li>
        <li><span class="notification">2</span> <a href="#club">Club Announcements</a></li>
        <li><span class="notification">2</span> <a href="#other">Other Announcements</a></li>
        <li><span class="notification">2</span> <a href="#job">Job Opportunities</a></li>
      </ul>
      <section id="general">
        <h2>General Annoucements</h2>
        <hr />
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
      </section>
      <section id="club">
        <h2>Club Annoucements</h2>
        <hr />
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
      </section>
      <section id="other">
        <h2>Other Annoucements</h2>
        <hr />
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
      </section>
      <section id="job">
        <h2>Job Opportunities</h2>
        <hr />
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
        <article>
          <h4>Google Tech Talk</h4>
          <span class="date">Thursday March 30, 2017 @ 6pm</span>
          <span class="location">Fiedler 1107</span>
          <p>Zach Maier, Product Manager at Google and a 2009 ECE K-State Alum, will be hosting a Tech Talk on Thursday, March 30 at 6-7 pm in Fiedler 1107.</p>
        </article>
      </section>
    </div>
  </div>
</div>
@endsection
