<div class="container mx-auto mt-10 p-4 dark:bg-gray-900 dark:text-white">
    <h1 class="text-3xl font-bold mb-6">AI21 Integration</h1>
    <div id="chat-log" class="bg-gray-800 text-white p-4 rounded shadow-md mb-4 overflow-y-auto" style="height: 400px;"></div>
    <form id="chat-form" class="mb-4 flex">
        <textarea id="prompt" name="prompt" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Enter your message" cols="30" rows="2"></textarea>
        <button type="submit" id="ask-button" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">Ask</button>
    </form>
    <div id="loader" class="hidden">Loading...</div>
</div>

@push("scripts")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const conversationHistory = [
            {
                "text": "You are an AI assistant for business research. Your responses should be informative and concise.",
                "role": "system"
            }
        ];

        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const prompt = document.getElementById('prompt');
            const chatLog = document.getElementById('chat-log');
            const loader = document.getElementById('loader');
            const askButton = document.getElementById('ask-button');

            const userMessage = prompt.value;
            if (userMessage.trim() === "") return;

            // Append user message to conversation history
            conversationHistory.push({
                "text": userMessage,
                "role": "user"
            });

            // Display user message in chat log
            chatLog.innerHTML += `<div class="bg-gray-700 p-2 rounded mb-2"><strong>You:</strong> ${userMessage}</div>`;
            prompt.value = "";

            // Show loader and disable input
            loader.classList.remove('hidden');
            prompt.disabled = true;
            askButton.disabled = true;

            fetch('{{ route("getAiResponse") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ messages: conversationHistory })
            })
            .then(response => response.json())
            .then(data => {
                // Hide loader and enable input
                loader.classList.add('hidden');
                prompt.disabled = false;
                askButton.disabled = false;

                // Append AI response to conversation history
                conversationHistory.push({
                    "text": data.ai_response,
                    "role": "assistant"
                });

                // Display AI response in chat log
                chatLog.innerHTML += `<div class="bg-gray-600 p-2 rounded mb-2"><strong>AI:</strong> ${data.ai_response}</div>`;

                // Scroll to the bottom of the chat log
                chatLog.scrollTop = chatLog.scrollHeight;
            })
            .catch(error => {
                // Hide loader and enable input
                loader.classList.add('hidden');
                prompt.disabled = false;
                askButton.disabled = false;

                console.error('Error:', error);
            });
        });

        // Set dark mode class on body
        document.body.classList.add('dark');
    });
</script>
@endpush
