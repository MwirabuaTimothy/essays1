@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Account
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/styles/css/account.css')}} ">
@stop


@section('js')

    <!-- bxSlider assets -->
    <script src="{{ asset('assets/bxslider/jquery.bxslider.js') }}"></script>
    <link href="{{ asset('assets/bxslider/jquery.bxslider.css') }}" rel="stylesheet" />


    <script type="text/javascript">
        function deletePop(evnt) {
            // evnt.preventDefault();
            var title = $(evnt).attr('data-title');
            var message = $(evnt).attr('data-content');
            console.log(evnt);

            function formSubmit(){
                $(evnt).parent('form').submit();
            }

            if (!jQuery('#dataConfirmModal').length) {
                jQuery('body').append('<div id="dataConfirmModal" class="modal fade"\
                 role="dialog" aria-labelledby="dataConfirmLabel" aria-hidden="true">\
                 <div class="modal-header">\
                 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">\
                 ×</button><h3 id="dataConfirmLabel">'+title+'</h3></div>\
                 <div class="modal-body">'+message+'</div><div class="modal-footer">\
                 <button class="btn btn-success" data-dismiss="modal" aria-hidden="true">\
                 No</button><a class="btn btn-danger" data-dismiss="modal" id="dataConfirmOK">\
                 Yes</a></div></div>');
            } 

            jQuery('#dataConfirmModal').find('.modal-body').text(message);
            jQuery('a#dataConfirmOK').on('click', function(){
                formSubmit();
            });
            jQuery('#dataConfirmModal').modal({show:true});

        };
    </script>
@stop



@section('content')

<!-- <div id="search_space">Search</div> -->
<ul class="nav nav-tabs myTabs" data-tabs="tabs">
    <li><a href="#account" data-toggle="tab">Account</a></li>
    <li>{{{ $user->booksLink() }}}</li>
    <li><a href="#tabs-2" data-toggle="tab">Get Cash Now</a></li>
    <li><a href="#tabs-3" data-toggle="tab">Cheetah delivery</a></li>
</ul>

<div id="tabs" class="tab-content">

    <div id="account"  class="tab-pane active">

        <div class="middle_content">
            <div class="title_text"><span>User Details</span> <span style="float:right">Account SetUp Progress</span></div>

            <div class="user_details_space">

                <div class="imagespace">

                @if(Auth::user()->id == $user->id() )
                <input class="btn btn-primary submitbook" type="submit" value="Add Photo" style="font-size: 15px; float:left;">
                @endif
                </div>

                <table class="userdetails">
                    <tr><td>Name </td><td>: {{ $user->fullName() }}</td></tr>
                    <tr><td>Email </td><td>: {{ $user->mailto() }}</td></tr>
                    <tr><td>Mobile Contacts </td><td>: {{ $user->contacts() }}</td></tr>
                    <tr><td>College </td><td>: {{ $user->CollegeLink() }}</td></tr>
                    <tr><td>{{ $user->bookshelfLink() }}</td><td>| {{ $user->wishlistLink() }}</td></tr>
                </table>

                <div class="progress progress-striped">
                  <div class="progress-bar progress-bar-info" style="width: 80%"></div>
                </div>

                <a href="{{ URL::to('user/'.$user->id().'/edit') }}">
                    @if(Auth::user()->id == $user->id() )
                    <div class="editbtn"><input class="btn btn-primary submitbook" type="submit" value="Edit Profile" style="font-size: 15px;">
                    </div>
                    @endif
                </a>
                
            </div>


            <div class="title_text"><span>Courses</span></div>
            <div class="course_table">

               <!-- <div id="PeopleTableContainer" style="width: 100%; margin:2px 0 0 5px;">
               </div> -->
                    
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="width:15%; overflow:hidden;">Course Number</th>
                                <th style="width:50%; overflow:hidden;">Course Name</th>
                                <th style="width:20%; overflow:hidden;">Professor</th>
                                <th style="width:10%; overflow:hidden;">Semester</th>
                                <th style="width:5%; overflow:hidden;">-</th>
                            </tr>
                        </thead>

                        <tbody class="student">
                        @if (isset($courses['0']))
                            @foreach ($courses as $course)

<?php 
if(DB::table('courses')->where('id', 'like', $course->courseid)->get()):
$cours = DB::table('courses')->where('id', 'like', $course->courseid)->get();
?>
                                <tr>
                                    <td>
                                        {{{ $cours['0']->number }}}
                                    </td>
                                    <td>
                                        <a href="{{{ URL::to('courses/'.$cours['0']->id) }}}">
                                        {{{ $cours['0']->name }}}
                                        </a>
                                        <a onClick="$(this).parent('td').parent('tr').parent('tbody').children('#{{{ $cours['0']->id }}}').slideToggle()" style="float:right">
                                        View Books
                                        </a>
                                    </td>
                                    <td>
                                         {{{ $cours['0']->professor }}}
                                    </td>
                                    <td>
                                         {{{ $cours['0']->semester }}}
                                    </td>
                                    <td>
                                    @if(Auth::user()->id == $user->id)

                                        {{ Form::open(array('method' => 'DELETE', 'route' => array('courselists.destroy', $course->id))) }}
                                            {{ Form::submit('.', array(
                                            'class' => 'delete',
                                            'onClick' => 'event.preventDefault(); deletePop(this);',
                                            'data-title' => $cours['0']->name,
                                            'data-content' => 'Are you sure you want to remove this course?',
                                            )) }}
                                        {{ Form::close() }}
                                    
                                    @endif
                                    </td>

                                </tr>
                                
                                <tr id="{{{ $cours['0']->id }}}" style="display:none">
                                    <td>Books</td>
                                    <td>
                                    <?php
                                    $bookslist = $cours['0']->books;
                                    $booksArray = explode("\r\n", $bookslist);
                                    // $booksArray = preg_split("/\\r\\n|\\r|\\n", $bookslist);
                                    echo '<ol>';
                                    foreach ($booksArray as $key => $value) {
                                        echo '<li>'.$value.'</li>';
                                    }
                                    echo '</ol>';
                                    ?>
                                    </td>
                                </tr>
                                
@endif

                            @endforeach
                            @else
                                You have not added any courses yet.
                            @endif
                        </tbody>
                    </table>
                    
               

                @if(Auth::user()->id == $user->id)
                        {{ Form::open(array('action' => 'CoursesController@search', 'method' => 'GET', 'id' => 'courseadder')) }}
                            {{ Form::text('coursename', 'Add a course...', array(
                                'class' => 'searchinput searchcourses', 
                                'style' => 'bottom: 5px; position: relative; float: left;',
                                'placeholder' => 'Type a Course name...',
                                'onclick' => 'if (this.value==\'Add a course...\') this.value=\'\'',
                                'onblur' => 'if (this.value==\'\') this.value=\'Add a course...\''
                                )) }}
                            <input type="text" style="display:none" name="userid" value="1"/>
                            <input type="text" style="display:none" name="username" value="James"/>
                            <input type="text" style="display:none" name="courseid" value="3"/>
                            <input type="submit" style="display:none"/>
                        {{ Form::close() }}
                @endif

                <a href="{{{ URL::to('user') }}}" class="btn btn-primary savebook">Save</a>

                {{ link_to_route('courses.index', 'Admin Panel', null, array(
                'class'=>'btn btn-primary submitbook',
                'style'=>'float:right;'
                )) }}


            </div>
        </div>
        <div class="bottom_content">
            <div class="title_text"><span>Popular Books</span></div>

            <div class="popular_slider">

                <div id="bottom">
                    <!-- <ul id="bxslider2">
                        <li><img src="assets/bxslider/images/img-1.jpg" title="1" /></li>
                        <li><img src="assets/bxslider/images/img-2.jpg" title="2" /></li>
                        <li><img src="assets/bxslider/images/img-3.jpg" title="3" /></li>
                        <li><img src="assets/bxslider/images/img-4.jpg" title="4" /></li>
                        <li><img src="assets/bxslider/images/img-5.jpg" title="4" /></li>
                    </ul> -->
                 </div>
            </div>
            <div class="popular_text">

            </div>
        </div>

    </div>

    <div id="mybooks" class="tab-pane" data-content="{{ URL::to('user/books') }}" >Loading... If its taking too long, please check your connection
    </div>

    <div id="tabs-2" class="tab-pane">
        <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
    </div>
    <div id="tabs-3" class="tab-pane">
        <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
        <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
    </div>
</div>
@stop

