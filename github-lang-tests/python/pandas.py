    csv = pd.read_csv('scrable.csv',usecols = ['col1'], on_bad_lines='skip')
    csv = pd.read_csv('scrable.csv', nrows=0).columns.tolist()
    csv = pd.read_csv('scrable.csv', nrows=0).columns.tolist()

    colnames=['competition_auction_id'] 
    csv = pd.read_csv('scrable.csv', names=colnames, header=None, on_bad_lines='skip')
    csv = pd.read_csv('scrable.csv', names=colnames, header=None, on_bad_lines='skip')

    colnames=['competition_auction_id'] 
    csv = pd.read_csv('scrable.csv', names=colnames, header=None, on_bad_lines='skip')
    print(csv)

    colnames=['competition_auction_id'] 
    csv = pd.read_csv('scrable.csv', names=colnames, header=None, on_bad_lines='skip')
    print(csv)

    auctionId = ""
    for row in range(0, 5):
        a = print(csv.loc[row, colnames].values)
