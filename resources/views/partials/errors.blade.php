<div class="alert alert-danger">
    <ul>
        {% for input,messages in errors %}
            {% for message in messages %}
                <li>{{ input }}: {{ message }}</li>
            {% endfor %}
        {% endfor %}
    </ul>
</div>