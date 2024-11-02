import React, { useState } from 'react';
import { deleteInvoice } from './api'; // assuming you have an API function to delete an invoice
import Alert from 'react-bootstrap/Alert';

function DeleteInvoice(props) {
  const [successMsg, setSuccessMsg] = useState('');
  const [errorMsg, setErrorMsg] = useState('');

  const handleDelete = () => {
    const invoiceId = props.invoiceId;
    deleteInvoice(invoiceId)
      .then(() => {
        setSuccessMsg('Invoice deleted successfully.');
        setErrorMsg('');
      })
      .catch((error) => {
        setErrorMsg(`Error deleting invoice: ${error.message}`);
        setSuccessMsg('');
      });
  };

  return (
    <div>
      <button onClick={handleDelete}>Delete Invoice</button>
      {successMsg && (
        <Alert variant="success" className="mt-3">
          {successMsg}
        </Alert>
      )}
      {errorMsg && (
        <Alert variant="danger" className="mt-3">
          {errorMsg}
        </Alert>
      )}
    </div>
  );
}

export default DeleteInvoice;
