from flask import Flask, render_template_string

app = Flask(__name__)

@app.route('/')
def home():
    return render_template_string("""
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Ma Page Web</title>
        </head>
        <body>
            <h1>Bienvenue sur ma page web !</h1>
            <p>Ceci est une page simple générée avec Python et Flask.</p>
        </body>
        </html>
    """)

if __name__ == '__main__':
    app.run(debug=True)
