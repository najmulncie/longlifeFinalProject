


<!-- টাস্ক ডিটেইল -->
<h1>{{ $task->title }}</h1>
<p>{{ $task->description }}</p>
<p>Amount: {{ $task->amount }}</p>

<!-- টাস্ক লিঙ্ক -->
<a href="{{ route('task.redirect', $task->id) }}" target="_blank">Go to Task</a>

<!-- সাবমিট বাটন, যা শুরুতে হিডেন থাকবে -->
<form action="{{ route('tasks.submit', $task->id) }}" method="POST">
    @csrf
    <button type="submit" style="display:none;">Submit Task</button>
</form>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<!-- জাভাস্ক্রিপ্ট -->
<script>
    document.querySelector('a[target="_blank"]').addEventListener('click', function() {
        window.addEventListener('focus', function() {
            document.querySelector('form button').style.display = 'block';
        }, { once: true });
    });
</script>
