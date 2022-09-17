@extends('layouts.admin')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Addresses</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.customer_addresses.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Address</span>
                </a>
            </div>
        </div>

        @include('backend.customer_addresses.filter.filter')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Customer</th>
                    <th>Title</th>
                    <th>Shipping Info</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Zip code</th>
                    <th>POBox</th>
                    <th class="text-center" style="width: 30px;">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customer_addresses as $addresses)
                    <tr>
                        <td><a href="{{route('admin.customers.show',$addresses->user_id)}}">{{$addresses->user->full_name}}</a></td>
                        <td>
                            <a href="{{route('admin.customer_addresses.show',$addresses->id)}}">{{$addresses->address_title}}</a>
                            <p class="text-gray-400">{{$addresses->defaultAddress()}}</p>
                        </td>
                        <td>
                            {{$addresses->first_name. '' .$addresses->last_name}}
                            <p class="text-gray-400">{{$addresses->email}}<br>{{$addresses->mobile}}</p>
                        </td>
                        <td>{{ $addresses->country->name. ' - ' . $addresses->state->name .' - ' . $addresses->city->name }}</td>
                        <td>{{$addresses->address}}</td>
                        <td>{{$addresses->zip_code}}</td>
                        <td>{{$addresses->po_box}}</td>
                        <td>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('admin.customer_addresses.edit', $addresses->id) }}" class="btn btn-primary">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="if (confirm('Are you sure to delete this record?')) { document.getElementById('delete-address-{{ $addresses->id }}').submit(); } else { return false; }" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                            <form action="{{ route('admin.customer_addresses.destroy', $addresses->id) }}" method="post" id="delete-address-{{ $addresses->id }}" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No Addresses found</td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="8">
                            <div class="float-right">
                                {!! $customer_addresses->appends(request()->all())->links() !!}
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
