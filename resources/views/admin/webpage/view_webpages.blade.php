@extends('admin.components.layout')
@push('css')
    <style>
        section:has(table) {
            padding: 20px;
            box-shadow: 0 0 10px 0 #00000033;
            border-radius: 8px;
            background: white;
            flex-grow: 1;
        }

        table {
            width: 100%;
        }

        table :is(th, td) {
            text-align: left;
            padding: 5px 10px;
        }

        table th:first-of-type {
            width: 80px;
        }

        table td.imp {
            font-weight: 600;
            color: var(--error);
            font-size: 1.4rem;
        }

        table td:has(i.icon) {
            display: flex;
            gap: 4px;
        }

        table td i.icon {
            width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            aspect-ratio: 1;
        }
    </style>
@endpush
@section('main')
    <main class="cflex">
        <div>
            <h1 class="page_title">Web Page</h1>
            <p class="page_sub_title">Be Careful Bro</p>
        </div>
        <section class="panel">
            <table>
                <thead>
                    <tr>
                        <th>Sr.No.</th>
                        <th>Slug</th>
                        <th>Page Title</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($webpages as $i => $webpage)
                        <tr>
                            <th>{{ $i + 1 }}</th>
                            <td @class(['imp' => $webpage['slug'] == '*' || $webpage['slug'] == ''])>@php
                                if ($webpage['slug'] == '') {
                                    echo 'Home Page';
                                } elseif ($webpage['slug'] == '*') {
                                    echo 'Universal';
                                } else {
                                    echo $webpage['slug'];
                            } @endphp</td>
                            <td>{{ $webpage['page_title'] }}</td>
                            <td>
                                <i class="icon fa-solid fa-eye"></i>
                                <a href="{{url("admin/webpage/edit/".$webpage['id'])}}">
                                    <i class="icon fa-solid fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
