@extends('user.user_dashboard')

@section('title', 'My Jobs')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h3>My {{ $task->title }} Job Details</h3><span></span>
                        @if (session('success'))
                            <p style="color: green;">{{ session('success') }}</p>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="row_create" style="width:100%">
                                <tbody>
                                <tr>
                                    <th>Title</th>
                                    <td>{{ $task->title }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $task->description }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $task->amount }} Tk</td>
                                </tr>
                                <tr>
                                    <th></th>
                                    <td>
                                        <a href="{{ $task->link }}" class="btn btn-sm btn-primary go-to-task-btn" target="_blank">Go to- Task</a>

                                        <!-- সাবমিট বাটন, যা শুরুতে হিডেন থাকবে -->
                                        <form action="{{ route('tasks.submit', $task->id) }}" method="POST" class="submit-task-form">
                                            @csrf
                                            <button class="btn btn-sm btn-primary submit-task-btn" type="submit" style="display:none;">Submit Task</button>
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var goToTaskBtn = document.querySelector('.go-to-task-btn');
            var userId = "{{ auth()->id() }}"; // ইউজারের আইডি
            var taskId = "{{ $task->id }}"; // টাস্কের আইডি
            var lastCompletedAt = "{{ $task->users->find(auth()->id()) ? $task->users->find(auth()->id())->pivot->completed_at : null }}"; // ইউজারের জন্য শেষ সম্পন্নের সময়
            var currentTime = new Date().getTime();

            // যদি ইউজার টাস্ক সম্পন্ন করে থাকে তবে ২৪ ঘণ্টা চেক করুন
            if (lastCompletedAt) {
                var lastCompletedTime = new Date(lastCompletedAt).getTime();
                var hours24Later = lastCompletedTime + 24 * 60 * 60 * 1000; // ২৪ ঘণ্টা পরে

                // চেক করা হবে ২৪ ঘণ্টা পার হয়েছে কিনা
                if (currentTime < hours24Later) {
                    goToTaskBtn.disabled = true; // বাটনটি নিষ্ক্রিয় করা হচ্ছে
                    goToTaskBtn.innerText = 'Wait for 24 hours'; // মেসেজ আপডেট
                }
            }

            // টাস্ক সম্পন্ন হলে সাবমিট বাটন দেখানোর লগিক
            goToTaskBtn.addEventListener('click', function(event) {
                if (goToTaskBtn.disabled) {
                    event.preventDefault(); // নিষ্ক্রিয় হলে ক্লিক প্রতিরোধ করা হচ্ছে
                } else {
                    event.preventDefault(); // ক্লিকের ডিফল্ট আচরণ প্রতিরোধ
                    var link = this.href;
                    window.open(link, '_blank');

                    var submitBtn = this.closest('td').querySelector('.submit-task-btn');
                    window.addEventListener('focus', function() {
                        goToTaskBtn.style.display = 'none';
                        submitBtn.style.display = 'block';
                    }, { once: true });
                }
            });
        });
    </script>



@endsection

























{{--<script>--}}
{{--    // যখন Go to Task বাটনে ক্লিক হবে, নতুন ট্যাব ওপেন হবে--}}
{{--    document.querySelectorAll('.go-to-task-btn').forEach(function(goToTaskBtn) {--}}
{{--        goToTaskBtn.addEventListener('click', function(event) {--}}
{{--            var link = this.href; // টাস্ক লিংকটি--}}
{{--            // নতুন ট্যাবে লিংক ওপেন করা--}}
{{--            window.open(link, '_blank');--}}

{{--            // নতুন ট্যাব থেকে ব্যাক আসলে সাবমিট বাটন দেখাবে--}}
{{--            var submitBtn = this.closest('td').querySelector('.submit-task-btn');--}}
{{--            window.addEventListener('focus', function() {--}}
{{--                goToTaskBtn.style.display = 'none'; // Go to Task বাটন লুকানো হবে--}}
{{--                submitBtn.style.display = 'block'; // সাবমিট বাটন দেখানো হবে--}}
{{--            }, { once: true }); // শুধু একবারই কাজ করবে--}}
{{--        });--}}
{{--    });--}}
{{--</script>--}}


