<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewertung abgeben — {{ $user->name ?? 'Praxis' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <div class="max-w-lg mx-auto px-4 py-12">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-star text-yellow-500 text-2xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Bewertung abgeben</h1>
            <p class="text-gray-500 text-sm">Deine Meinung hilft {{ $user->name ?? 'dieser Praxis' }} besser zu werden.</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-center">
                <i class="fa-solid fa-check-circle text-3xl mb-2 text-green-500"></i>
                <p class="font-semibold">{{ session('success') }}</p>
                <p class="text-sm mt-1">Vielen Dank für deine Bewertung!</p>
            </div>
        @endif

        <!-- Review Form -->
        @if(!session('success'))
        <div class="bg-white rounded-2xl border shadow-sm p-6">
            <form action="#" method="POST" id="reviewForm">
                @csrf

                <!-- Star Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Bewertung</label>
                    <div class="flex items-center gap-2" id="starRating">
                        @for($i = 1; $i <= 5; $i++)
                            <button type="button" data-value="{{ $i }}" class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition focus:outline-none">
                                <i class="fa-solid fa-star"></i>
                            </button>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="0">
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dein Name</label>
                    <input type="text" name="author" required maxlength="100"
                           class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-yellow-200 focus:border-yellow-400 outline-none"
                           placeholder="Max Mustermann">
                </div>

                <!-- Comment -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deine Bewertung</label>
                    <textarea name="comment" rows="4" required maxlength="500"
                              class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-yellow-200 focus:border-yellow-400 outline-none resize-none"
                              placeholder="Was hat dir gut gefallen? Was können wir besser machen?"></textarea>
                    <div class="text-xs text-gray-400 mt-1">Max. 500 Zeichen</div>
                </div>

                <!-- Submit -->
                <button type="submit" id="submitBtn" disabled
                        class="w-full py-3 bg-yellow-500 text-white rounded-xl font-bold text-lg hover:bg-yellow-600 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fa-solid fa-paper-plane mr-2"></i>Bewertung absenden
                </button>
            </form>
        </div>
        @endif

        <!-- Footer -->
        <div class="text-center mt-8 text-xs text-gray-400">
            <p>Powered by <strong>Praxis Website Score</strong></p>
        </div>
    </div>

    <script>
        const stars = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('ratingInput');
        const submitBtn = document.getElementById('submitBtn');

        stars.forEach(star => {
            star.addEventListener('click', () => {
                const val = parseInt(star.dataset.value);
                ratingInput.value = val;
                stars.forEach((s, i) => {
                    s.classList.toggle('text-yellow-400', i < val);
                    s.classList.toggle('text-gray-300', i >= val);
                });
                submitBtn.disabled = val === 0;
            });
        });
    </script>
</body>
</html>
