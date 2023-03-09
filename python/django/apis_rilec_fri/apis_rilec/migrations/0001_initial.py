# Generated by Django 4.1.7 on 2023-03-09 00:12

from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    initial = True

    dependencies = [
    ]

    operations = [
        migrations.CreateModel(
            name='DataSet',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('timestamp', models.DateTimeField()),
                ('valid_from', models.DateTimeField()),
                ('valid_to', models.DateTimeField()),
            ],
        ),
        migrations.CreateModel(
            name='DataSource',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('source', models.CharField(choices=[('apis', 'Apis'), ('studis', 'Studis')], max_length=32)),
                ('timestamp', models.DateTimeField()),
                ('data', models.BinaryField()),
            ],
        ),
        migrations.CreateModel(
            name='LDAPAction',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('action', models.CharField(choices=[('user_upsert', 'Upsert user data'), ('add', 'Add'), ('delete', 'Delete')], max_length=16)),
                ('dn', models.TextField()),
                ('data', models.JSONField()),
                ('sources', models.ManyToManyField(to='apis_rilec.dataset')),
            ],
        ),
        migrations.CreateModel(
            name='LDAPActionBatch',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('description', models.CharField(blank=True, default='', max_length=512)),
                ('actions', models.ManyToManyField(to='apis_rilec.ldapaction')),
            ],
        ),
        migrations.CreateModel(
            name='UserData',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('timestamp', models.DateTimeField()),
                ('uid', models.CharField(max_length=64)),
                ('source', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='apis_rilec.datasource')),
            ],
        ),
        migrations.CreateModel(
            name='UserDataField',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('valid_from', models.DateTimeField(null=True)),
                ('valid_to', models.DateTimeField(null=True)),
                ('changed_t', models.DateTimeField(null=True)),
                ('field', models.CharField(max_length=256)),
                ('value', models.CharField(max_length=512)),
                ('userdata', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, related_name='fields', to='apis_rilec.userdata')),
            ],
        ),
        migrations.CreateModel(
            name='OURelation',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('timestamp', models.DateTimeField()),
                ('valid_from', models.DateTimeField()),
                ('valid_to', models.DateTimeField()),
                ('relation', models.CharField(max_length=64)),
                ('ou1_id', models.CharField(max_length=32)),
                ('ou2_id', models.CharField(max_length=32)),
                ('source', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='apis_rilec.datasource')),
            ],
        ),
        migrations.CreateModel(
            name='OUData',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('timestamp', models.DateTimeField()),
                ('valid_from', models.DateTimeField()),
                ('valid_to', models.DateTimeField()),
                ('uid', models.CharField(max_length=64)),
                ('name', models.CharField(max_length=256)),
                ('shortname', models.CharField(max_length=32)),
                ('source', models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='apis_rilec.datasource')),
            ],
        ),
        migrations.CreateModel(
            name='LDAPApply',
            fields=[
                ('id', models.BigAutoField(auto_created=True, primary_key=True, serialize=False, verbose_name='ID')),
                ('result', models.JSONField()),
                ('timestamp', models.DateTimeField()),
                ('batch', models.ForeignKey(on_delete=django.db.models.deletion.RESTRICT, to='apis_rilec.ldapactionbatch')),
            ],
        ),
        migrations.AddField(
            model_name='dataset',
            name='source',
            field=models.ForeignKey(on_delete=django.db.models.deletion.CASCADE, to='apis_rilec.datasource'),
        ),
    ]
