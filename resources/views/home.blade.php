@extends('layouts.app')

@section('content')
<div class="container">

    <div class="mb-3 row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscribe</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('fail') }}
                        </div>
                    @endif
                    <form id="frmSubscription" action="{{route('subscribe')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="eamil">Email</label>
                            <input type="text" class="form-control" name="email" id="eamil">
                        </div>
                        <input id="btnSubscribe" onclick="subscribe(event)" type="submit" value="Subscribe" class="btn btn-primary float-right">
                        <input id="btnUnSubscribe" onclick="unSubscribe(event)" type="submit" value="UnSubscribe" class="btn btn-danger">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscribers & UnSubscribers</div>

                <div class="card-body">
                    @if (session('email'))
                        <div class="alert alert-success" role="alert">
                            {{ session('email') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <b>Subscribers</b>
                                @foreach($subscribers as $subscriber)
                                    <li>{{$subscriber}}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="col-6">
                            <ul>
                                <b>UnSubscribers</b>
                                @foreach($unSubscribers as $unSubscriber)
                                    <li>{{$unSubscriber}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="/emails-to-subscribers" class="btn btn-secondary">Send Mails To Subscribers</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    <script type="application/javascript">
        function subscribe(event){
            event.preventDefault();
            let form= document.getElementById('frmSubscription');
            form.setAttribute('action', '/subscribe');
            form.submit();
        }

        function unSubscribe(event){
            event.preventDefault();
            let form= document.getElementById('frmSubscription');
            form.setAttribute('action', '/unSubscribe');
            form.submit();
        }
    </script>
@endsection

