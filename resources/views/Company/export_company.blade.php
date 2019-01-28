<table id="companyTable" class="table-bordered table-condensed text-center table-striped" style="width:100%">
    <thead>
    <tr>
        <th>Name</th>
        <th>Company Information</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone 1</th>
        <th>Phone 2</th>
        {{--<th>Action</th>--}}
    </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
            <tr>
                <td>{{ $company->companyName }}</td>
                <td>{{ $company->companyInfo }}</td>
                <td>{{ $company->companyEmail }}</td>
                <td>{{ $company->companyAddress }}</td>
                <td>{{ $company->companyPhone1 }}</td>
                <td>{{ $company->companyPhone2 }}</td>
            </tr>
        @endforeach
    </tbody>
</table>