<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Health Insights</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #e63946;
            --secondary-color: #457b9d;
            --accent-color: #a8dadc;
            --light-color: #f1faee;
            --dark-color: #1d3557;
            --transition-speed: 0.4s;
            --shadow-soft: 0 5px 15px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 8px 20px rgba(0, 0, 0, 0.12);
            --shadow-strong: 0 10px 25px rgba(0, 0, 0, 0.15);
            --border-radius: 12px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: all var(--transition-speed) cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--dark-color);
            line-height: 1.6;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 25px;
        }

        header {
            background: linear-gradient(145deg, var(--primary-color), #ce2836);
            color: white;
            padding: 28px 0;
            text-align: center;
            box-shadow: var(--shadow-medium);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, rgba(255,255,255,0) 70%);
            transform: rotate(30deg);
            animation: shimmer 8s infinite linear;
        }

        @keyframes shimmer {
            0% { transform: rotate(30deg) translateY(0); }
            50% { transform: rotate(30deg) translateY(5%); }
            100% { transform: rotate(30deg) translateY(0); }
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
            position: relative;
            z-index: 1;
        }

        .logo i {
            font-size: 2.8rem;
            margin-right: 18px;
            animation: pulse 2.5s infinite;
            filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.2));
            color: #fff;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.15); opacity: 0.9; }
            100% { transform: scale(1); opacity: 1; }
        }

        h1 {
            font-size: 2.4rem;
            margin-bottom: 8px;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.15);
        }

        .tagline {
            font-size: 1.1rem;
            opacity: 0.95;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto;
        }

        main {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 40px 0;
            position: relative;
        }

        #chatbox {
            flex: 1;
            height: 480px;
            overflow-y: auto;
            background-color: white;
            border-radius: var(--border-radius);
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: var(--shadow-soft);
            scroll-behavior: smooth;
            border: 1px solid rgba(69, 123, 157, 0.1);
        }

        #chatbox::-webkit-scrollbar {
            width: 8px;
        }

        #chatbox::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #chatbox::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 10px;
        }

        #chatbox::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-color);
            opacity: 0.7;
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .message {
            max-width: 80%;
            padding: 16px 20px;
            border-radius: 20px;
            position: relative;
            animation: fadeIn 0.5s ease-in-out;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.05);
            line-height: 1.5;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .user {
            align-self: flex-end;
            background: linear-gradient(135deg, var(--secondary-color), #2a6f97);
            color: white;
            border-bottom-right-radius: 5px;
        }

        .bot {
            align-self: flex-start;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: var(--dark-color);
            border: 1px solid rgba(230, 57, 70, 0.15);
            border-bottom-left-radius: 5px;
        }

        .message::before {
            content: '';
            position: absolute;
            bottom: -2px;
            width: 12px;
            height: 12px;
            z-index: -1;
        }

        .user::before {
            right: -2px;
            border-radius: 0 0 50% 0;
            box-shadow: 3px 3px 0 #2a6f97;
        }

        .bot::before {
            left: -2px;
            border-radius: 0 0 0 50%;
            box-shadow: -3px 3px 0 rgba(230, 57, 70, 0.1);
        }

        .message-content {
            margin-bottom: 6px;
            font-size: 1.02rem;
        }

        .timestamp {
            font-size: 0.75rem;
            opacity: 0.8;
            text-align: right;
            margin-top: 6px;
            font-style: italic;
        }

        .input-area {
            display: flex;
            gap: 12px;
            margin-top: 15px;
            position: relative;
        }

        #userInput {
            flex: 1;
            padding: 16px 22px;
            border: 2px solid transparent;
            border-radius: 30px;
            background-color: white;
            font-size: 1.05rem;
            box-shadow: var(--shadow-soft);
            outline: none;
            transition: all 0.4s ease;
        }

        #userInput:focus {
            box-shadow: 0 0 0 3px rgba(230, 57, 70, 0.2), var(--shadow-medium);
            transform: translateY(-2px);
            border-color: rgba(230, 57, 70, 0.3);
        }

        #userInput::placeholder {
            color: #aaa;
            font-weight: 300;
        }

        button {
            background: linear-gradient(145deg, var(--secondary-color), #2a6f97);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 0 30px;
            height: 55px;
            cursor: pointer;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            box-shadow: var(--shadow-medium);
            font-size: 1rem;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: 0.6s;
        }

        button:hover {
            background: linear-gradient(145deg, #2a6f97, var(--secondary-color));
            transform: translateY(-3px);
            box-shadow: var(--shadow-strong);
        }

        button:hover::before {
            left: 100%;
        }

        button:active {
            transform: translateY(1px);
            box-shadow: var(--shadow-soft);
        }

        button i {
            font-size: 1.1rem;
        }

        footer {
            background-color: var(--dark-color);
            color: white;
            text-align: center;
            padding: 22px 0;
            margin-top: 40px;
            font-size: 0.95rem;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--primary-color));
            animation: gradient 8s linear infinite;
            background-size: 200% 200%;
        }

        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .typing-indicator {
            display: inline-flex;
            align-items: center;
            margin-left: 15px;
        }

        .typing-indicator span {
            height: 9px;
            width: 9px;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: inline-block;
            margin: 0 3px;
            opacity: 0.7;
        }

        .typing-indicator span:nth-child(1) {
            animation: bounce 1s infinite 0.2s;
        }

        .typing-indicator span:nth-child(2) {
            animation: bounce 1s infinite 0.4s;
        }

        .typing-indicator span:nth-child(3) {
            animation: bounce 1s infinite 0.6s;
        }

        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }

        /* Adding some UI details for modern feel */
        .message.user {
            position: relative;
        }

        .message.user::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            border-radius: 20px;
            pointer-events: none;
        }

        .message.bot {
            position: relative;
        }

        .message.bot::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom left, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0));
            border-radius: 20px;
            pointer-events: none;
        }

        .heartbeat-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0,50 L20,50 L25,20 L30,80 L35,50 L100,50' stroke='%23e63946' stroke-width='1' fill='none' opacity='0.05'/%3E%3C/svg%3E");
            opacity: 0.05;
            z-index: 0;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            #chatbox {
                height: 420px;
                padding: 20px;
            }
            
            .message {
                max-width: 90%;
                padding: 14px 18px;
            }
            
            button {
                padding: 0 20px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.7rem;
            }
            
            .logo i {
                font-size: 2.2rem;
            }
            
            .message {
                max-width: 95%;
            }
            
            button span {
                display: none;
            }
            
            button {
                width: 55px;
                justify-content: center;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <i class="fas fa-heartbeat"></i>
                <h1>Heart Health Insights</h1>
            </div>
            <p class="tagline">Your personal AI assistant for heart health information</p>
        </div>
    </header>
    
    <main class="container">
        <div class="heartbeat-bg"></div>
        <div id="chatbox">
            <div class="chat-container" id="chatContainer">
                <div class="message bot">
                    <div class="message-content">Welcome to Heart Health Insights! I'm here to answer your questions about heart health, provide tips for a healthier lifestyle, and help you understand cardiovascular wellness. What would you like to know today?</div>
                    <div class="timestamp">Just now</div>
                </div>
            </div>
        </div>
        
        <div class="input-area">
            <input type="text" id="userInput" placeholder="Ask about heart health..." />
            <button onclick="sendMessage()">
                <i class="fas fa-paper-plane"></i>
                <span>Send</span>
            </button>
        </div>
    </main>
    
    <script>
        const chatContainer = document.getElementById("chatContainer");
        const input = document.getElementById("userInput");


        // Define allowed heart-health keywords
        const allowedKeywords = [
  "heart",
  "cardio",
  "heartbeat",
  "blood pressure",
  "cholesterol",
  "triglycerides",
  "hypertension",
  "atherosclerosis",
  "angina",
  "stroke",
  "myocardial infarction",
  "heart failure",
  "cardiomyopathy",
  "congenital heart disease",
  "endocarditis",
  "pericarditis",
  "cardiogenic shock",
  "arrhythmia",
  "tachycardia",
  "bradycardia",
  "fibrillation",
  "flutter",
  "palpitations",
  "aortic stenosis",
  "mitral regurgitation",
  "aorta",
  "atrium",
  "atria",
  "ventricle",
  "ventricles",
  "septum",
  "valve",
  "artery",
  "vein",
  "capillary",
  "sinoatrial node",
  "sa node",
  "atrioventricular node",
  "av node",
  "ecg",
  "ekg",
  "echocardiogram",
  "stress test",
  "angiogram",
  "holter monitor",
  "doppler ultrasound",
  "troponin",
  "bnp",
  "angioplasty",
  "stent",
  "bypass",
  "cabg",
  "pacemaker",
  "defibrillator",
  "valve replacement",
  "smoking",
  "obesity",
  "diabetes",
  "inactivity",
  "stress",
  "diet",
  "salt intake",
  "alcohol",
  "beta blocker",
  "ace inhibitor",
  "angiotensin receptor blocker",
  "statin",
  "diuretic",
  "calcium channel blocker",
  "anticoagulant",
  "aspirin",
  "ejection fraction",
  "ef",
  "cardiac enzymes",
  "creatine kinase",
  "ck-mb",
  "ldh",
  "echocardiography",
  "cardiac catheterization",
  "cardioversion",
  "ablation",
  "pci",
  "percutaneous coronary intervention",
  "thrombolysis",
  "embolectomy",
  "valvuloplasty",
  "coronary artery disease",
  "cad",
  "ischemia",
  "infarction",
  "plaque",
  "endothelial dysfunction",
  "vascular",
  "atheroma",
  "cardiology",
  "interventional cardiology",
  "electrophysiology",
  "stress echo",
  "nuclear stress test",
  "heart rate variability",
  "hrv"
        ];
        
        input.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                sendMessage();
            }
        });
        
        async function sendMessage() {
            const userMessage = input.value.trim();
            if (!userMessage) return;
            
            // Check if message contains any allowed heart-related keyword
            const lowerMsg = userMessage.toLowerCase();
            const isAllowed = allowedKeywords.some(keyword => lowerMsg.includes(keyword));
            if (!isAllowed) {
                appendMessage("I'm sorry, I can only answer questions related to heart health. Please ask a heart-related question.", "bot");
                input.value = "";
                return;
            }
            
            // Display user message
            appendMessage(userMessage, "user");
            input.value = "";
            
            // Show typing indicator
            const typingIndicator = document.createElement("div");
            typingIndicator.className = "message bot typing";
            typingIndicator.innerHTML = `
                <div class="message-content">
                    <div class="typing-indicator">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            `;
            chatContainer.appendChild(typingIndicator);
            chatContainer.scrollTop = chatContainer.scrollHeight;
            
            try {
                const response = await fetch("https://api.openai.com/v1/chat/completions", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Authorization": `Bearer ${API_KEY}`
                    },
                    body: JSON.stringify({
                        model: "gpt-3.5-turbo",
                        messages: [
                            { 
                                role: "system", 
                                content: "You are a helpful assistant focused on heart health. Provide accurate, evidence-based information about cardiovascular health, prevention strategies, and healthy lifestyle choices. Make your responses friendly and accessible without being overly technical." 
                            },
                            { role: "user", content: userMessage }
                        ]
                    })
                });
                
                // Remove typing indicator
                chatContainer.removeChild(typingIndicator);
                
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                
                const data = await response.json();
                const botMessage = data.choices[0].message.content;
                
                // Display bot message with slight delay for natural feel
                setTimeout(() => {
                    appendMessage(botMessage, "bot");
                }, 300);
                
            } catch (error) {
                // Remove typing indicator
                chatContainer.removeChild(typingIndicator);
                
                // Display error message
                appendMessage("I apologize, but I'm having trouble connecting right now. Please try again later.", "bot");
                console.error("Error:", error);
            }
        }
        
        function appendMessage(text, sender) {
            const time = new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            const div = document.createElement("div");
            div.className = `message ${sender}`;
            div.innerHTML = `
                <div class="message-content">${text}</div>
                <div class="timestamp">${time}</div>
            `;
            chatContainer.appendChild(div);
            
            // Add entrance animation
            div.style.opacity = "0";
            div.style.transform = "translateY(20px)";
            
            // Trigger reflow to ensure animation plays
            void div.offsetWidth;
            
            // Apply animation
            div.style.opacity = "1";
            div.style.transform = "translateY(0)";
            
            // Smooth scroll to bottom
            setTimeout(() => {
                chatContainer.scrollTop = chatContainer.scrollHeight;
            }, 50);
        }
    </script>
</body>
</html>