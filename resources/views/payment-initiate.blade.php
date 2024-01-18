<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
<link href="{{asset('css/style.css')}}" rel="stylesheet">
<div class="container">
  <form action="{{url('/payment-initiate-request')}}" align="center" method="post">
    @csrf
    <div class="row">
      <div class="col-25">
        <label for="name">Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name" placeholder="Your Name..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="email">Email </label>
      </div>
      <div class="col-75">
        <input type="email" id="lname" name="email" placeholder="Your Email">
      </div>
    </div>
    
    <div class="row">
      <div class="col-25">
        <label for="amount">Amount</label>
      </div>
      <div class="col-75">
      <input type="amount" id="amount" name="amount" >
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Submit">
    </div>
  </form>
</div>