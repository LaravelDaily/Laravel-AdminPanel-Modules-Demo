<?php

namespace Modules\ContactManagement\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\ContactManagement\Http\Requests\MassDestroyContactContactRequest;
use Modules\ContactManagement\Http\Requests\StoreContactContactRequest;
use Modules\ContactManagement\Http\Requests\UpdateContactContactRequest;
use Modules\ContactManagement\Entities\ContactCompany;
use Modules\ContactManagement\Entities\ContactContact;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactContactsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contact_contact_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContacts = ContactContact::with(['company'])->get();

        return view('contactmanagement::admin.contactContacts.index', compact('contactContacts'));
    }

    public function create()
    {
        abort_if(Gate::denies('contact_contact_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('contactmanagement::admin.contactContacts.create', compact('companies'));
    }

    public function store(StoreContactContactRequest $request)
    {
        $contactContact = ContactContact::create($request->all());

        return redirect()->route('admin.contact-contacts.index');
    }

    public function edit(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = ContactCompany::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $contactContact->load('company');

        return view('contactmanagement::admin.contactContacts.edit', compact('companies', 'contactContact'));
    }

    public function update(UpdateContactContactRequest $request, ContactContact $contactContact)
    {
        $contactContact->update($request->all());

        return redirect()->route('admin.contact-contacts.index');
    }

    public function show(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->load('company');

        return view('contactmanagement::admin.contactContacts.show', compact('contactContact'));
    }

    public function destroy(ContactContact $contactContact)
    {
        abort_if(Gate::denies('contact_contact_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactContact->delete();

        return back();
    }

    public function massDestroy(MassDestroyContactContactRequest $request)
    {
        ContactContact::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
