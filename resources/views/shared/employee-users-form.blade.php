
<form action="{{route('employee.update', ['employee'=>$employee->id])}}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label class="form-label"> Name </label>
        <input type="text" class="form-control"  value="{{$employee->user->name}}">
    </div>

    <div class="mb-3">
        <label class="form-label"> Email </label>
        <input type="email" class="form-control"  value="{{$employee->user->email}}">
    </div>

    <div class="mb-3">
        <label class="form-label"> Phone </label>
        <input type="text" class="form-control"  value="{{$employee->user->telephone}}">
    </div>
    <hr>
    <div class="row mb-3">
        <div class="col">
            <label class="form-label"> Contract </label>
            <select id="inputState" class="form-select">
                @foreach( $contracts as $contract )
                    <option @if( $contract->id == $employee->contract->id ) selected @endif value="{{ $employee->contract->name }}" >{{ $contract->name }} - {{$contract->hours}}h / week</option>
                @endforeach
            </select>
        </div>

        <div class="col">
            <label class="form-label"> Department </label>
            <select id="inputState" class="form-select">
                @foreach( $departments as $department )
                    <option @if( $department->id == $employee->department->id ) selected @endif value="{{ $department->id }}" >{{ $department->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row m-0">
        <button class="btn btn-info">
            Save changes
        </button>
    </div>


</form>
