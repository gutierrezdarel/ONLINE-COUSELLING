<link rel="stylesheet" href="{{ asset('vendor/dist/custom/app-custom.css')}}">

@can('is-student-only')
<div class="list-group" id="list-tab" role="tablist">
    <div class="list-group-item heading pb-3 font-weight-bold">Categories </div>
    <a class="list-group-item list-group-item-action " id="personal-social-list" data-toggle="list" href="#personal-social" role="tab" aria-controls="home" >Personal/Social (<span class="text-danger font-weight-bold"  >{{$personalCount}}</span>)</a>
    <a class="list-group-item list-group-item-action" id="academic-list" data-toggle="list" href="#academic" role="tab" aria-controls="profile" >Academic (<span class="text-danger font-weight-bold">{{$academicCount}}</span>)</a>
    <a class="list-group-item list-group-item-action" id="career-list" data-toggle="list" href="#career" role="tab" aria-controls="messages">Career  (<span class="text-danger font-weight-bold">{{$careerCount}}</span>)</a>
</div>
@endcan

@can('is-guidance-only')
<div class="card sticky-top">
    <div class="card-header">
        <small class="text-left">Search Filter <i class="fas fa-filter"></i></small>
    </div>
    <div class="card-body">    
        <div class="filter">
            <form action="{{route('post.filter.search')}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <select class="form-control select2"name="student" id="">
                        <option value="" selected disabled>Filter Students</option>
                        <option value="">Select All</option>
                        @foreach ($filterStudents as $student)
                            <option value="{{$student->id}}"@isset($filteredStudent) @if($filteredStudent == $student->id) selected @endif @endisset>{{$student->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control select2"name="category" id="">
                        <option value="" selected disabled>Filter Categories</option>
                        <option value="">Select All</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" @isset($filteredCategory) @if($filteredCategory == $category->id) selected @endif @endisset >{{$category->category}}</option>
                        @endforeach
                    </select>
                </div>

                
                @isset($search)
                <div class="form-group">
                    <a href="{{route('home')}}" class="btn btn-danger" style="width:100%"><i class="fas fa-search"></i> Clear Filter</a>
                </div>
                @else
                <div class="form-group">
                    <button type="submit" class="btn text-light" style="width:100%"><i class="fas fa-search"></i> Search</button>
                </div>
                @endisset
            </form>
        </div>
    </div>
</div>
@endcan

<script>

</script>