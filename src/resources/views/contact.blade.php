@include('layouts.header')
@include('layouts.nav')

<div class="imgContact banner d-flex flex-column justify-content-center align-items-center">
    <h1 class="display-2 fw-bold text-white">Contact Me</h1>
    <h4 class="text-light">Have questions? I have answers!</h4>
</div>

<div class="container py-4 w-50 mx-auto">
    <form>
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone Number</label>
            <input type="tel" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Message</label>
            <textarea class="form-control" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send</button>
    </form>
</div>

@include('layouts.footer')
