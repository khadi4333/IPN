import React from 'react';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, useForm } from '@inertiajs/react';
import TextInput from '@/Components/TextInput';
import InputLabel from '@/Components/InputLabel';
import InputError from '@/Components/InputError';
import { Link } from '@inertiajs/react';

export default function Edit({ auth, expressionbesoin }) {
  const { data, setData, put, errors } = useForm({
    id_service: expressionbesoin.id_service || "",
    description: expressionbesoin.description || "",
  });

  const onSubmit = (e) => {
    e.preventDefault();
    put(route('expressionbesoin.update', expressionbesoin.id));
  };

  return (
    <AuthenticatedLayout
      user={auth.user}
      header={
        <div className='flex justify-between items-center'>
          <h2 className='font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight'>
            Edit ExpressionBesoin "{expressionbesoin.id_service}"
          </h2>
        </div>
      }
    >
      <Head title="Edit ExpressionBesoin" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div className="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div className="p-6 text-gray-900 dark:text-gray-100">
              <form onSubmit={onSubmit} className='p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg'>
                <div className='mt-4'>
                  <InputLabel htmlFor='id_service' value='ID Service' />
                  <TextInput
                    type="number"
                    name="id_service"
                    id="id_service"
                    value={data.id_service}
                    className="mt-1 block w-full"
                    onChange={(e) => setData('id_service', e.target.value)}
                  />
                  <InputError message={errors.id_service} className='mt-2' />
                </div>

                <div className='mt-4'>
                  <InputLabel htmlFor='description' value='Description' />
                  <TextInput
                    type="text"
                    name="description"
                    id="description"
                    value={data.description}
                    className="mt-1 block w-full"
                    onChange={(e) => setData('description', e.target.value)}
                  />
                  <InputError message={errors.description} className='mt-2' />
                </div>

                <div className='mt-4 text-right'>
                  <Link
                    href={route('expressionbesoin.index')}
                    className="py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                  >
                    Cancel
                  </Link>
                  <button
                    type="submit"
                    className="bg-emerald-500 py-1 px-3 text-white rounded shadow transition-all hover:bg-emerald-600"
                  >
                    Submit
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  );
}