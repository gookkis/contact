<div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($isUpdate)
        @livewire('contact-update')
    @else
        @livewire('contact-create')
    @endif

    <hr>

    <div class="row">
        <div class="ml-auto mr-3">
            <label for="search">Filter by Name : </label>
            <input wire:model="search" type="text" name="" id="" class="inline-form">
        </div>
    </div>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Phone</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <button class="btn btn-sm btn-info text-white"
                            wire:click="getContact({{ $item->id }})">Edit</button>
                        <button class="btn btn-sm btn-danger text-white"
                            wire:click="destroy({{ $item->id }})">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
    <div class="row">
        <div class="ml-auto mr-3"> <label for="paginate">Show Per Page : </label>
            <select wire:model="paginate" name="" id="" class="from-control form-contol-sm w-auto">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
            </select>
        </div>
    </div>
</div>
