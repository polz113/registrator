# Generated by Django 4.1.6 on 2023-02-12 21:08

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('apis_rilec', '0003_rename_ou_oudata_name_dataset_timestamp_and_more'),
    ]

    operations = [
        migrations.RenameField(
            model_name='oudata',
            old_name='short_OU',
            new_name='shortname',
        ),
    ]
