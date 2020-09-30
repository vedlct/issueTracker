<form method="post" action="{{ route('client.update') }}">
    @csrf
    <input type="hidden" value="{{ $client->clientId }}" name="clientId">
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Client Name *</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="name" value="{{ $client->clientName }}" placeholder="client name" required>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Client Official Email</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="email" value="{{ $client->clientEmail }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-3 col-form-label">Client Information</label>
        <div class="col-sm-9">
            <textarea class="form-control" name="info" placeholder="client information">{{ $client->clientInfo }}</textarea>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-primary pull-right">Update Client</button>
        </div>
    </div>
</form>
