<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $paginate = 5;
    public $isUpdate = false;
    public $search;
    protected $queryString = [
        'search' => ['except' => ''],
        'page' => ['except' => 1],
    ];

    protected $listeners = [
        'contactStored' => 'handleStored',
        'contactUpdated' => 'handleStored'
    ];

    public function mount()
    {
        $this->fill(request()->only('search', 'page'));
    }

    public function render()
    {

        return view('livewire.contact-index', [
            'data' => $this->search === null ?
                Contact::orderBy('id', 'desc')->paginate($this->paginate) :
                Contact::where('name', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    public function getContact($id)
    {
        $this->isUpdate = true;
        $contact = Contact::find($id);
        $this->emit('getContact', $contact);
    }

    public function destroy($id)
    {
        if ($id) {
            $contact = Contact::find($id);
            $contact->delete();
            session()->flash('message', 'Contact berhasil dihapus.');
        }
    }

    public function handleStored($contact)
    {
        session()->flash('message', 'Contact ' . $contact['name'] . ' berhasil disimpan.');
    }
}
