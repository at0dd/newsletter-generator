@extends('layouts.master')
@section('title', 'Guidelines')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6 col-md-offset-3">
      <h2>Guidelines</h2>
      
      <h3>Submissions</h3>
      <p>Submissions should be made through the <a href="{{ url('/contribute') }}">Contribute</a> page.</p>
      <p>Articles must be submitted no later than noon on Friday to publish the following week. Announcements will be published at the editor's discretion.</p>
      <p>All submissions must be in an article format — no lists, tables, etc.</p>
      <p>Only submissions pertaining to Computer Science will be accepted for publication. Announcements will only be accepted from Kansas State University administration, unit or official groups. A group is determined official when it includes elected officers and has established organizational operations and procedures. The Office of Student Activities and Services provides requirements for official student organizations.</p>
      <p>It is the submitter's responsibility to ensure information is accurate and respectful, and adheres to the university's <a href="http://www.k-state.edu/about/community.html" target="_blank">Principles of Community.</a></p>

      <h3>Review and Distribution</h3>
      <p>Computer Science Weekly will be emailed to Computer Science faculty, staff and students every Monday morning.</p>
      <p>The Computer Science department reserves the right to edit or deny any submissions.</p>
    </div>
  </div>
</div>
@endsection
